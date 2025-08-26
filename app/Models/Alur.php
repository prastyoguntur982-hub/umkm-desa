<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alur extends Model
{
     protected $table = 'alur';

     protected $fillable = ['kategori', 'gambar','uu_terkait', 'keterangan'];
}