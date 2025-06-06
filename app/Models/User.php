<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPasswordContract
{
    use CanResetPassword;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password', 'role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    public function scopeAdmins($query)
    {
        // PENAMBAHAN SCOPE INI
        // Sesuaikan array peran ini jika nama peran di sistem Anda berbeda
        return $query->whereIn('role', ['admin', 'superadmin']);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function isSuperAdmin(): bool
    {
        return in_array($this->role, ['admin', 'superadmin']);
    }

    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }

    public function isDosen(): bool
    {
        return $this->role === 'dosen';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'superadmin']);
    }
}
