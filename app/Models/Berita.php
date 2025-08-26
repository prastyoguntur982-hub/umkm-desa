<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = ['judul', 'slug', 'isi', 'foto'];

    public function views()
    {
        return $this->hasMany(BeritaView::class);
    }
}
