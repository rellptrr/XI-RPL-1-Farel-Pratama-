<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('transaksis', function (Blueprint $table) {
        // Tambahkan tarif_id untuk kategori kendaraan
        if (!Schema::hasColumn('transaksis', 'tarif_id')) {
            $table->unsignedBigInteger('tarif_id')->nullable()->after('plat_nomor');
            $table->foreign('tarif_id')->references('id')->on('tarifs')->onDelete('cascade');
        }

        // Tambahkan user_id untuk mencatat petugas
        if (!Schema::hasColumn('transaksis', 'user_id')) {
            $table->unsignedBigInteger('user_id')->nullable()->after('status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        }
    });
}

public function down()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->dropForeign(['tarif_id']);
        $table->dropForeign(['user_id']);
        $table->dropColumn(['tarif_id', 'user_id']);
    });
}
};
