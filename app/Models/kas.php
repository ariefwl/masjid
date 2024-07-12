<?php

namespace App\Models;

use App\Events\SaldoAkhirKas;
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
    
    
    // public $controllerId;
    // public $nilaiawal;
    // protected static function booted(): void
    // {
    //     static::created(function(kas $kas){
    //         // $saldoAkhir = kas::SaldoAkhir();
            
    //         // // saldo akhir ditambah transaksi masuk/keluar
    //         // if ($kas['jenis'] == 'masuk') {
    //         //     $saldoAkhir += $kas['jumlah'];
    //         // } else {
    //         //     $saldoAkhir -= $kas['jumlah'];
    //         // }
            
    //         // if ($saldoAkhir <= -1) {
    //         //     return response()->json(['msg' => 'gagal']);
    //         // }
    //         // $saldoKas = saldoAkhirKasQurban::first();
    //         // if ($saldoKas) {
    //         //     // Jika saldo kas ada, perbarui saldo_akhir
    //         //     $saldoKas->update(['saldo_akhir' => $saldoAkhir]);
    //         // } else {
    //         //     $kas = [
    //         //         'saldo_akhir' => $saldoAkhir,
    //         //         'created_by' => Auth()->user()->id
    //         //     ];
    //         //     saldoAkhirKasQurban::create($kas);
    //         // }
    //         // event(new SaldoAkhirKas(saldoAkhir: $saldoAkhir));
    //     });

    //     static::updated(function(kas $kas){
    //         // // Periksa apakah data ditemukan
    //         // $data = kas::find($kas->controllerId);
    //         // $awal = $kas->nilaiawal;
    //         // $saldoAkhir = kas::SaldoAkhir();
    //         // if ($data) {
    //         //     if ($data->jenis == 'masuk') {
    //         //         $saldoAkhir -= $awal;
    //         //         $saldoAkhir += $data->jumlah;
    //         //     } 
    //         //     if ($data->jenis == 'keluar') {
    //         //         $saldoAkhir += $awal;
    //         //         $saldoAkhir -= $kas->jumlah; 
    //         //     }
    //         //     // Update data
    //         //     $saldoKas = saldoAkhirKasQurban::first();
    //         //     $saldoKas->update(['saldo_akhir' => $saldoAkhir]);
    //         // }
    //         // event(new SaldoAkhirKas(saldoAkhir: $saldoAkhir));
    //     });
    // }
}
