<?php

namespace App\Models\InfoHarga;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pasar\Pasar; 

class DaftarHarga extends Model
{
     protected $table = 'daftar_harga';
     protected $fillable = [
        'pasar_id',
        'barang_id',
        'harga',
        'tanggal',
    ];

    public function daftarBarang()
    {
        return $this->belongsTo(DaftarBarang::class, 'barang_id');
    }

     public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }
}
