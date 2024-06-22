<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salurDaging extends Model
{
    use HasFactory;
    protected $fillable = ['penerima','id_jenis_daging','jumlah','berat','keterangan'];

    public function jenis()
    {
        return $this->belongsTo(jenis::class, 'id_jenis_daging');
    }
}
