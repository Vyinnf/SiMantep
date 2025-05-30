<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPKL extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'id',
        'user_id',
        'instansi_id',
        'nim',
        'prodi',
        'semester',
        'alamat_mahasiswa',
        'no_hp',
        'mahasiswa_id',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
