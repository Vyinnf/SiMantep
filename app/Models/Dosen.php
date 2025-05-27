<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dosen extends Authenticatable
{
    use Notifiable;

    protected $table = 'dosens';

    protected $fillable = [
        'name',
        'email',
        'password',
        'nip'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
