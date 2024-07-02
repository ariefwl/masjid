<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saldoAkhirKasQurban extends Model
{
    use HasFactory;
    
    protected $table = 'saldo_akhir_kas_qurban';
    protected $fillable = ['saldo_akhir','created_by'];
}
