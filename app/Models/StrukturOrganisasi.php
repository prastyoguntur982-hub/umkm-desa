<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan (struktur_organisasi -> StrukturOrganisasi)
    protected $table = 'struktur_organisasi';

    // Tentukan field yang bisa diisi
    protected $fillable = [
        'nama',
        'jabatan',
        'nip',
        'foto',
        'parent_id',
    ];

    // Mendefinisikan relasi parent-child
    // public function parent()
    // {
    //     return $this->belongsTo(StrukturOrganisasi::class, 'parent_id');
    // }

    // public function children()
    // {
    //     return $this->hasMany(StrukturOrganisasi::class, 'parent_id');
    // }
}
