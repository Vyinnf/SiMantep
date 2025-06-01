<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanInstansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_instansi',
        'alamat_instansi',
        'kontak_instansi',
        'user_id',
        'status',
        'catatan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
