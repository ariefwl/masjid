<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shohibul extends Model
{
    use HasFactory;

    protected $fillable = ['nama','alamat','telp','jenis']; 
}
