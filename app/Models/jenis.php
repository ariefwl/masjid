<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis extends Model
{
    use HasFactory;
    protected $fillable = ['id','nama_jenis'];

    public function salurDaging()
    {
        return $this->hasMany(salurDaging::class, 'id_jenis_daging');
    }
}

