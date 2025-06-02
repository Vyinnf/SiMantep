<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_pkls', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique()->nullable();
            $table->foreignId('user_id')->comment('ID User Mahasiswa')->constrained('users')->onDelete('cascade');
            $table->foreignId('instansi_id')->comment('ID Instansi Tujuan')->constrained('instansis')->onDelete('cascade'); // Pastikan nama tabel 'instansis' sudah benar
            $table->date('tanggal_mulai_pkl');
            $table->date('tanggal_selesai_pkl');
            $table->string('judul_pkl')->nullable(); // INI YANG PENTING SESUAI MODEL ANDA
            $table->enum('status_surat', ['diajukan', 'diproses', 'selesai_dibuat', 'diambil', 'ditolak'])->default('diajukan');
            $table->string('file_surat_path')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->foreignId('admin_user_id')->nullable()->comment('ID User Admin yang memproses')->constrained('users')->onDelete('set null');
            $table->timestamp('tanggal_disetujui_atau_dibuat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_pkls');
    }
};
