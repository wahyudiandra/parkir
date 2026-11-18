<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah tipe kolom jenis_kendaraan dari ENUM menjadi VARCHAR(50) agar menerima input teks bebas
        DB::statement("ALTER TABLE tb_tarif MODIFY jenis_kendaraan VARCHAR(50) NOT NULL");
        DB::statement("ALTER TABLE tb_kendaraan MODIFY jenis_kendaraan VARCHAR(50) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tb_tarif MODIFY jenis_kendaraan ENUM('motor', 'mobil', 'lainnya') NOT NULL");
        DB::statement("ALTER TABLE tb_kendaraan MODIFY jenis_kendaraan ENUM('motor', 'mobil', 'lainnya') NOT NULL");
    }
};