<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Table Users (Admin, Petugas, Owner)
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'petugas', 'owner'])->default('petugas')->after('email');
        });

        // Table Tarif Parkir
        Schema::create('tarif_parkirs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kendaraan'); // Mobil, Motor, Truk
            $table->decimal('tarif_per_jam', 10, 2);
            $table->timestamps();
        });

        // Table Area Parkir
        Schema::create('area_parkirs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_area');
            $table->integer('kapasitas');
            $table->integer('terisi')->default(0);
            $table->timestamps();
        });

        // Table Kendaraan
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('plat_nomor')->unique();
            $table->foreignId('tarif_parkir_id')->constrained('tarif_parkirs')->onDelete('cascade');
            $table->timestamps();
        });

        // Table Transaksi
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket')->unique();
            $table->string('plat_nomor');
            $table->foreignId('tarif_parkir_id')->constrained('tarif_parkirs');
            $table->foreignId('area_parkir_id')->constrained('area_parkirs');
            $table->foreignId('petugas_id')->constrained('users');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->decimal('total_bayar', 10, 2)->nullable();
            $table->enum('status', ['masuk', 'keluar'])->default('masuk');
            $table->timestamps();
        });

        // Table Log Aktivitas
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('aktivitas');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('transaksis');
        Schema::dropIfExists('kendaraans');
        Schema::dropIfExists('area_parkirs');
        Schema::dropIfExists('tarif_parkirs');
    }
};