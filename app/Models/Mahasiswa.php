<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;
    protected $table = 'mahasiswas';
    protected $fillable = ['nim', 'nama', 'password', 'photo'];
    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('images/avatar.png');
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }
}
