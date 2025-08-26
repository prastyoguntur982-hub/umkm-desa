<?php

namespace App\Models\Pasar;


use Illuminate\Database\Eloquent\Model;

class DetailPasar extends Model
{

    protected $fillable = ['pasar_id', 'kategori', 'keterangan', 'deskripsi'];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }
}
