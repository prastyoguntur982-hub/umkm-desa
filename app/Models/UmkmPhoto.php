<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/UmkmPhoto.php
class UmkmPhoto extends Model
{
    protected $fillable = ['umkm_id', 'photo'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
