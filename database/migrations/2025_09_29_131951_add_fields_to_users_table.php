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
        Schema::table('users', function (Blueprint $table) {
            // 1. Ganti nama kolom 'name' menjadi 'nama_lengkap'
            $table->renameColumn('name', 'nama_lengkap');

            // 2. Tambahkan kolom 'role' setelah kolom 'password'
            $table->enum('role', ['admin', 'customer'])->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->renameColumn('nama_lengkap', 'name');
        });
    }
};
