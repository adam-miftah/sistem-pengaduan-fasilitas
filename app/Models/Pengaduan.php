<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'lokasi',
        'foto',
        'status', 
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriFasilitas::class, 'kategori_id');
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class);
    }
}
