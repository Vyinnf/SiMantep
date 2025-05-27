<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPKL extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_p_k_l_s';

    protected $fillable = [
        'mahasiswa_id',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
