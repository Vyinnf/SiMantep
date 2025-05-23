<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataMahasiswa extends Migration
{
    /**
     * Jalankan perubahan pada tabel `mahasiswas`
     */
    public function up()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            // Cek kolom satu per satu agar tidak error duplikat
            if (!Schema::hasColumn('mahasiswas', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('mahasiswas', 'nama')) {
                $table->string('nama')->nullable();
            }

            if (!Schema::hasColumn('mahasiswas', 'nim')) {
                $table->string('nim')->nullable();
            }

            if (!Schema::hasColumn('mahasiswas', 'semester')) {
                $table->integer('semester')->nullable();
            }

            if (!Schema::hasColumn('mahasiswas', 'prodi')) {
                $table->string('prodi')->nullable();
            }

            if (!Schema::hasColumn('mahasiswas', 'ttl')) {
                $table->string('ttl')->nullable();
            }

            if (!Schema::hasColumn('mahasiswas', 'alamat')) {
                $table->text('alamat')->nullable();
            }

            if (!Schema::hasColumn('mahasiswas', 'foto')) {
                $table->string('foto')->nullable();
            }
        });
    }

    /**
     * Undo perubahan
     */
    public function down()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'nama',
                'nim',
                'semester',
                'prodi',
                'ttl',
                'alamat',
                'foto',
            ]);
        });
    }
}
