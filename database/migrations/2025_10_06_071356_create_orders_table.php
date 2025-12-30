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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->decimal('total_harga_awal', 15, 2);
            $table->decimal('total_diskon', 15, 2)->default(0);
            $table->decimal('total_harga_akhir', 15, 2);
            $table->string('no_hp');
            $table->text('alamat_pengiriman');
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'proses', 'dikirim', 'selesai', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
