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
        Schema::table('area_parkirs', function (Blueprint $table) {
            $table->enum('jenis_kendaraan', ['motor', 'mobil', 'mobil_besar'])->after('nama_area');
        });
    }

    public function down(): void
    {
        Schema::table('area_parkirs', function (Blueprint $table) {
            $table->dropColumn('jenis_kendaraan');
        });
    }
};
