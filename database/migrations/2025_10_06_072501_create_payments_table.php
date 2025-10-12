<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('jenis_pembayaran', ['full', 'dp'])->default('full');
            $table->decimal('total_order', 10, 2);
            $table->decimal('jumlah_terbayar', 10, 2)->default(0);
            $table->decimal('sisa_pembayaran', 10, 2)->default(0);
            $table->enum('metode_pembayaran', ['credit_card', 'bank_transfer', 'e_wallet', 'cash_on_delivery', 'qris'])->default('bank_transfer');
            $table->string('bukti_pembayaran')->nullable();
            $table->dateTime('tanggal_bayar');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
