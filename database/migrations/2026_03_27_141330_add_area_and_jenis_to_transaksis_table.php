<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->enum('jenis_kendaraan', ['motor', 'mobil', 'mobil_besar'])->after('tarif_id');
            $table->foreignId('area_id')->nullable()->constrained('area_parkirs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn('jenis_kendaraan');
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
        });
    }
};