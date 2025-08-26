<?php

namespace App\Models\Galeri;

use Illuminate\Database\Eloquent\Model;

class KategoriGaleri extends Model
{
    
    protected $fillable = [
        'nama',
        'foto',
        'tanggal',
    ];

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }
}
