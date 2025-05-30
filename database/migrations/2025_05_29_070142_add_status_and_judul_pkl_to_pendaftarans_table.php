<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPendaftaransTable extends Migration
{
    public function up()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending')->after('alamat_instansi');
        });
    }

    public function down()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

