<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hewan extends Model
{
    use HasFactory;

    protected $fillable = ['id_jenis','nama_hewan','umur','jenis','bobot','status','foto','qr_code'];
}
