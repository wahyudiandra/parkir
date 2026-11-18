<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tb_log_aktivitas MODIFY aktivitas VARCHAR(255) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tb_log_aktivitas MODIFY aktivitas VARCHAR(100) NOT NULL");
    }
};