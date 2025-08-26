<?php

namespace App\Models\Galeri;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = [
        'kategori_galeri_id',
        'foto',
    ];

    public function kategoriGaleri()
    {
        return $this->belongsTo(KategoriGaleri::class, 'kategori_galeri_id');
    }
}
