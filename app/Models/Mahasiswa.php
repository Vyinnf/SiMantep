<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'mahasiswa';

    protected $fillable = [
        'user_id', 'nama', 'email', 'nim', 'semester', 'prodi', 'ttl', 'alamat', 'foto'
    ];

    protected $hidden = [
        'password',
    ];



    //App\Models\Mahasiswa.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
