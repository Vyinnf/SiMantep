<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            if (!Schema::hasColumn('admins', 'role')) {
                // Tambahkan kolom role setelah kolom 'password' atau 'email'
                $table->string('role')->default('admin')->after('password');
                // Nilai default bisa 'admin' atau peran lain yang paling umum
            }
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            if (Schema::hasColumn('admins', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
