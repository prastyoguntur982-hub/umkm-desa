<?php

namespace App\Models\InfoHarga;

use Illuminate\Database\Eloquent\Model;

class DaftarBarang extends Model
{

    protected $table = 'daftar_barang';
    protected $fillable = [
        'nama',
        'satuan',
        'foto',
    ];

    public function daftarHarga()
    {
        return $this->hasMany(DaftarHarga::class);
    }
}
