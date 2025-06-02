<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('mahasiswa')->after('email');
            }
            // Pertimbangkan juga untuk menambahkan kolom lain jika diperlukan,
            // misalnya 'is_active' untuk menonaktifkan akun tanpa menghapus.
            // if (!Schema::hasColumn('users', 'is_active')) {
            //     $table->boolean('is_active')->default(true)->after('role');
            // }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            // if (Schema::hasColumn('users', 'is_active')) {
            //     $table->dropColumn('is_active');
            // }
        });
    }
};
