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
        Schema::create('tb_tarif', function (Blueprint $table) {
            $table->id('id_tarif'); // Kita buat Primary Key-nya spesifik
            $table->string('jenis_kendaraan'); // Untuk isi 'Motor' atau 'Mobil'
            $table->integer('biaya'); // Untuk isi harga, misal 2000
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tarif');
    }
};
