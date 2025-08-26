<?php

namespace App\Models\Pasar;

use Illuminate\Database\Eloquent\Model;


class DokumenPasar extends Model
{
   

    protected $table = 'dokumen_pasars';

    protected $fillable = [
        'pasar_id',
        'judul',
        'deskripsi',
        'berkas',
    ];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }
}
