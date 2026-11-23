<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_transaksi', function (Blueprint $table) {
            // Izinkan id_kendaraan kosong (null) untuk transaksi manual
            $table->unsignedBigInteger('id_kendaraan')->nullable()->change();

            // Simpan data kendaraan manual langsung di tb_transaksi (tidak masuk ke tb_kendaraan Admin)
            $table->string('plat_manual', 25)->nullable()->after('id_kendaraan');
            $table->string('jenis_manual', 50)->nullable()->after('plat_manual');
            $table->string('warna_manual', 30)->nullable()->after('jenis_manual');
            $table->string('pemilik_manual', 100)->nullable()->after('warna_manual');
        });
    }

    public function down(): void
    {
        Schema::table('tb_transaksi', function (Blueprint $table) {
            $table->dropColumn(['plat_manual', 'jenis_manual', 'warna_manual', 'pemilik_manual']);
        });
    }
};