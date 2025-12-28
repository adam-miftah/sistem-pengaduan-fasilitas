<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'isi_tanggapan',
        'foto',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
