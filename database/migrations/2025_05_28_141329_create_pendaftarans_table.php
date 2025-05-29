<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('instansi_id');
            $table->string('nim', 20);
            $table->string('prodi', 100);
            $table->integer('semester');
            $table->string('alamat_mahasiswa');
            $table->string('no_hp', 15);
            $table->string('alamat_instansi');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('instansi_id')->references('id')->on('instansis')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
}
