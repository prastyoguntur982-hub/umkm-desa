<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Umkm.php
class Umkm extends Model
{
    protected $fillable = [
        'nama_produk',
        'nama_pemilik',
        'kategori',
        'deskripsi',
        'lokasi',
        'link_wa',
        'link_shopee',
        'link_tokopedia',
        'link_tiktok',
        'primary_photo',
    ];

    public function photos()
    {
        return $this->hasMany(UmkmPhoto::class);
    }
}

