<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kas extends Model
{
    use HasFactory;
    protected $table = "kas_qurban";
    protected $fillable = ['tanggal','kategori','keterangan','jenis','jumlah','created_by'];

    protected $casts = [
        'tanggal' => 'datetime:d-m-Y',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeSaldoAkhir($query)
    {
         // Ambil nilai saldo_akhir terbaru dari tabel saldoAkhirKasQurban
        $saldoKas = saldoAkhirKasQurban::orderBy('created_at', 'desc')->value('saldo_akhir');

        // Kembalikan nilai saldo_akhir atau 0 jika tidak ditemukan
        return $saldoKas ?? 0;
    }
}
