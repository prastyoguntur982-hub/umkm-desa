<?php

namespace App\Models\Pasar;

use Illuminate\Database\Eloquent\Model;
use App\Models\InfoHarga\DaftarHarga;

class Pasar extends Model
{

    protected $fillable = ['nama', 'alamat', 'foto'];

    public function detailPasar()
    {
        return $this->hasMany(DetailPasar::class);
    }
    public function dokumen()
    {
        return $this->hasMany(DokumenPasar::class);
    }

    public function daftarHarga()
    {
        return $this->hasMany(DaftarHarga::class);
    }
}
