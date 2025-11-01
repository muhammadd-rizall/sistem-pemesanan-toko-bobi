<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /**
     * Kirim OTP ke email user.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return response()->json(['message' => 'Email tidak terdaftar.'], 404);
        }

        // Buat OTP 6 digit
        $otp = rand(100000, 999999);

        // Simpan OTP hash ke tabel
        DB::table('customers_password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'otp_code' => Hash::make($otp),
                'expires_at' => Carbon::now()->addMinutes(10),
                'attempts' => 0,
                'is_used' => false,
                'created_at' => Carbon::now(),
            ]
        );

        // Kirim OTP lewat email
       Mail::to($request->email)->send(new OtpMail($otp));

        return response()->json(['message' => 'Kode OTP telah dikirim ke email Anda.']);
    }

    /**
     * Verifikasi OTP yang dimasukkan user.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $record = DB::table('customers_password_reset_tokens')
                    ->where('email', $request->email)
                    ->first();

        if (!$record) {
            return response()->json(['message' => 'Kode OTP tidak ditemukan.'], 404);
        }

        // Cek apakah OTP sudah digunakan
        if ($record->is_used) {
            return response()->json(['message' => 'Kode OTP sudah digunakan.'], 400);
        }

        // Cek apakah OTP sudah kadaluarsa
        if (Carbon::now()->greaterThan($record->expires_at)) {
            DB::table('customers_password_reset_tokens')->where('email', $request->email)->delete();
            return response()->json(['message' => 'Kode OTP sudah kadaluarsa.'], 400);
        }

        //  Cek jumlah percobaan sebelum validasi
        if ($record->attempts >= 3) {
            DB::table('customers_password_reset_tokens')->where('email', $request->email)->delete();
            return response()->json(['message' => 'Terlalu banyak percobaan salah. OTP dihapus.'], 429);
        }

        // Cek apakah OTP cocok
        if (!Hash::check($request->otp, $record->otp_code)) {
            // Tambahkan attempts
            DB::table('customers_password_reset_tokens')
                ->where('email', $request->email)
                ->increment('attempts');

            $remainingAttempts = 3 - ($record->attempts + 1);

            return response()->json([
                'message' => 'Kode OTP salah.',
                'remaining_attempts' => max(0, $remainingAttempts)
            ], 400);
        }

        //  OTP valid → tandai sudah digunakan
        DB::table('customers_password_reset_tokens')
            ->where('email', $request->email)
            ->update(['is_used' => true]);

        return response()->json(['message' => 'OTP valid. Silakan ubah password Anda.']);
    }

    /**
     * Ubah password user setelah OTP valid.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $record = DB::table('customers_password_reset_tokens')
                    ->where('email', $request->email)
                    ->where('is_used', true)
                    ->first();

        if (!$record) {
            return response()->json(['message' => 'OTP belum diverifikasi atau tidak ditemukan.'], 404);
        }

        // Cek apakah token masih valid (belum expired)
        if (Carbon::now()->greaterThan($record->expires_at)) {
            DB::table('customers_password_reset_tokens')->where('email', $request->email)->delete();
            return response()->json(['message' => 'Sesi reset password sudah kadaluarsa. Silakan minta OTP baru.'], 400);
        }

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return response()->json(['message' => 'User tidak ditemukan.'], 404);
        }

        // Update password
        $customer->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus OTP setelah berhasil
        DB::table('customers_password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password berhasil diubah. Silakan login kembali.']);
    }

    /**
     * (Opsional) Kirim ulang OTP jika user belum menerimanya.
     */
    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return response()->json(['message' => 'Email tidak terdaftar.'], 404);
        }

        //  Cek apakah ada OTP yang masih valid dan belum digunakan
        $existingToken = DB::table('customers_password_reset_tokens')
            ->where('email', $request->email)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($existingToken) {
            //  Cegah spam resend (minimal 1 menit sejak OTP terakhir)
            $createdAt = Carbon::parse($existingToken->created_at);
            if ($createdAt->diffInSeconds(Carbon::now()) < 60) {
                return response()->json([
                    'message' => 'Harap tunggu 1 menit sebelum mengirim ulang OTP.',
                    'retry_after' => 60 - $createdAt->diffInSeconds(Carbon::now())
                ], 429);
            }
        }

        // Hapus OTP lama
        DB::table('customers_password_reset_tokens')->where('email', $request->email)->delete();

        // Generate OTP baru
        $otp = rand(100000, 999999);

        DB::table('customers_password_reset_tokens')->insert([
            'email' => $request->email,
            'otp_code' => Hash::make($otp),
            'expires_at' => Carbon::now()->addMinutes(10),
            'attempts' => 0,
            'is_used' => false,
            'created_at' => Carbon::now(),
        ]);

        // Kirim ulang via email
        Mail::raw("Kode OTP reset password baru Anda adalah: $otp (berlaku 10 menit).", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Kode OTP Baru Reset Password');
        });

        return response()->json(['message' => 'Kode OTP baru telah dikirim.']);
    }
}
