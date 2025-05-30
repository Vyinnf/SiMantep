<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('judul_pkl')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
        });
    }

    public function down()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['judul_pkl', 'status']);
        });
    }
};
