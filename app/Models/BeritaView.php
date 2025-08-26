<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaView extends Model
{
    public $timestamps = false;
    protected $table = 'berita_views';

    protected $fillable = ['berita_id', 'ip_address', 'user_agent', 'viewed_at'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}

