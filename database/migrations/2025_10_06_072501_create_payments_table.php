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
            $table->enum('metode_pembayaran',['cod','midtrans'])->default('midtrans');
            $table->string('snap_token')->nullable();
             $table->string('snap_redirect_url')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->dateTime('tanggal_bayar')->nullable();
            $table->string('pembayaran_status');
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
