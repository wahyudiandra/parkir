<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. tb_user
        if (!Schema::hasTable('tb_user')) {
            Schema::create('tb_user', function (Blueprint $table) {
                $table->id('id_user');
                $table->string('nama_lengkap', 50);
                $table->string('username', 50)->unique();
                $table->string('email')->nullable();
                $table->string('password', 100);
                $table->enum('role', ['admin', 'petugas', 'owner'])->default('petugas');
                $table->boolean('status_aktif')->default(1);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // 2. tb_kendaraan
        if (!Schema::hasTable('tb_kendaraan')) {
            Schema::create('tb_kendaraan', function (Blueprint $table) {
                $table->id('id_kendaraan');
                $table->string('plat_nomor', 15)->unique();
                $table->string('jenis_kendaraan', 20);
                $table->string('warna', 20)->nullable();
                $table->string('pemilik', 100)->nullable();
                $table->unsignedBigInteger('id_user')->nullable();
                $table->timestamps();

                $table->foreign('id_user')->references('id_user')->on('tb_user')->onDelete('cascade');
            });
        }

        // 3. tb_tarif
        if (!Schema::hasTable('tb_tarif')) {
            Schema::create('tb_tarif', function (Blueprint $table) {
                $table->id('id_tarif');
                $table->enum('jenis_kendaraan', ['motor', 'mobil', 'lainnya']);
                $table->decimal('tarif_per_jam', 10, 0);
                $table->timestamps();
            });
        }

        // 4. tb_area_parkir
        if (!Schema::hasTable('tb_area_parkir')) {
            Schema::create('tb_area_parkir', function (Blueprint $table) {
                $table->id('id_area');
                $table->string('nama_area', 50);
                $table->integer('kapasitas');
                $table->integer('terisi')->default(0);
                $table->timestamps();
            });
        }

        // 5. tb_transaksi
        if (!Schema::hasTable('tb_transaksi')) {
            Schema::create('tb_transaksi', function (Blueprint $table) {
                $table->id('id_parkir');
                $table->unsignedBigInteger('id_kendaraan');
                $table->dateTime('waktu_masuk');
                $table->dateTime('waktu_keluar')->nullable();
                $table->unsignedBigInteger('id_tarif')->nullable();
                $table->integer('durasi_jam')->nullable();
                $table->decimal('biaya_total', 10, 0)->nullable();
                $table->enum('status', ['masuk', 'keluar'])->default('masuk');
                $table->unsignedBigInteger('id_user');
                $table->unsignedBigInteger('id_area');
                $table->timestamps();

                $table->foreign('id_kendaraan')->references('id_kendaraan')->on('tb_kendaraan')->onDelete('cascade');
                $table->foreign('id_tarif')->references('id_tarif')->on('tb_tarif')->onDelete('set null');
                $table->foreign('id_user')->references('id_user')->on('tb_user')->onDelete('cascade');
                $table->foreign('id_area')->references('id_area')->on('tb_area_parkir')->onDelete('cascade');
            });
        }

        // 6. tb_log_aktivitas
        if (!Schema::hasTable('tb_log_aktivitas')) {
            Schema::create('tb_log_aktivitas', function (Blueprint $table) {
                $table->id('id_log');
                $table->unsignedBigInteger('id_user');
                $table->string('aktivitas', 100);
                $table->dateTime('waktu_aktivitas');
                $table->timestamps();

                $table->foreign('id_user')->references('id_user')->on('tb_user')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_log_aktivitas');
        Schema::dropIfExists('tb_transaksi');
        Schema::dropIfExists('tb_area_parkir');
        Schema::dropIfExists('tb_tarif');
        Schema::dropIfExists('tb_kendaraan');
        Schema::dropIfExists('tb_user');
    }
};