<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    protected $fillable = [
        'instagram',
        'facebook',
        'youtube',
        'website',
        'twitter',
    ];
}
