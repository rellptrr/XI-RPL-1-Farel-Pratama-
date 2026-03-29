<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel transaksis.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique(); // Contoh: TRX-1703202601
            $table->string('plat_nomor');
            $table->dateTime('jam_masuk');
            $table->dateTime('jam_keluar')->nullable(); // Nullable karena diisi pas keluar
            $table->integer('total_bayar')->default(0);
            $table->enum('status', ['Masuk', 'Selesai'])->default('Masuk');
            $table->timestamps(); // Membuat kolom created_at dan updated_at
        });
    }

    /**
     * Batalkan migrasi (Hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};