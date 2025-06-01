<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPkl extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'user_id',
        'instansi_id',
        'tanggal_mulai_pkl',
        'tanggal_selesai_pkl',
        'judul_pkl',
        'status_surat',
        'file_surat_path',
        'catatan_admin',
        'admin_user_id',
        'tanggal_disetujui_atau_dibuat',
    ];

    protected $casts = [
        'tanggal_mulai_pkl' => 'date',
        'tanggal_selesai_pkl' => 'date',
        'tanggal_disetujui_atau_dibuat' => 'datetime',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    public function adminPemroses()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }
}
