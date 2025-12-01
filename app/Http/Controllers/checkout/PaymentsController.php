<?php

namespace App\Http\Controllers\checkout;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentsController extends Controller
{
    // Midtrans callback
    public function midtransCallback(Request $request)
    {
        // Set konfigurasi Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid notification signature.'], 400);
        }

        $transactionStatus = $notif->transaction_status;
        $fraudStatus = $notif->fraud_status;
        $orderId = $notif->order_id;

        // Cari order berdasarkan invoice_number
        $order = Order::where('invoice_number', $orderId)->first();
        if (!$order) {
            return response()->json(['error' => 'Order not found.'], 404);
        }

        // Handle status transaksi
        if ($transactionStatus == 'capture') {
            // 'capture' biasanya untuk kartu kredit, dianggap lunas jika fraud status 'accept'
            if ($fraudStatus == 'accept') {
                $this->updateOrderAndPayment($order, 'paid', 'proses', $notif);
            }
        } else if ($transactionStatus == 'settlement') {
            // 'settlement' berarti pembayaran berhasil dan dana sudah masuk
            $this->updateOrderAndPayment($order, 'paid', 'proses', $notif);
        } else if ($transactionStatus == 'pending') {
            // 'pending' berarti pembayaran belum selesai
            $this->updateOrderAndPayment($order, 'pending', 'pending', $notif);
        } else if (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            // 'cancel', 'deny', 'expire' berarti pembayaran gagal
            $this->updateOrderAndPayment($order, 'failed', 'cancelled', $notif);
        }

        return response()->json(['message' => 'OK']);
    }


    /**
     * Update status Order dan Payment di dalam satu transaksi database.
     */
    protected function updateOrderAndPayment(Order $order, string $paymentStatus, string $orderStatus, Notification $notif)
    {
        DB::transaction(function () use ($order, $paymentStatus, $orderStatus, $notif) {
            // Update status order
            $order->update(['status' => $orderStatus]);

            // Update atau buat data payment
            Payment::updateOrCreate(
                [
                    'order_id' => $order->id
                ],
                [
                    'pembayaran_status' => $paymentStatus,
                    'jumlah_terbayar'   => in_array($paymentStatus, ['paid', 'settlement']) ? $notif->gross_amount : 0,
                    'sisa_pembayaran'   => in_array($paymentStatus, ['paid', 'settlement']) ? 0 : $notif->gross_amount,
                    'tanggal_bayar'     => in_array($paymentStatus, ['paid', 'settlement']) ? now() : null,
                    'metode_pembayaran' => 'midtrans' 
                ]
            );
        });
    }
}
