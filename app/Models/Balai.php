<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balai extends Model
{
     protected $table = 'balai';

     protected $fillable = ['kategori', 'alamat', 'deskripsi'];
}