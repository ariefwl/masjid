<?php

namespace App\Observers;

use App\Events\GetRevenue;
use App\Events\SaldoAkhirKas;
use App\Models\kas;
use App\Models\saldoAkhirKasQurban;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KasObserver
{
    /**
     * Handle the kas "created" event.
     */
    public function created(kas $kas): void
    {
        $saldoAkhir = kas::SaldoAkhir();
            
            // saldo akhir ditambah transaksi masuk/keluar
            if ($kas['jenis'] == 'masuk') {
                $saldoAkhir += $kas['jumlah'];
            } else {
                $saldoAkhir -= $kas['jumlah'];
            }
            
            if ($saldoAkhir <= -1) {
                // return response()->json(['msg' => 'gagal']);
                Log::error('Saldo akhir kurang dari 0, transaksi gagal.', ['kas' => $kas]);
            return;
            }
            $saldoKas = saldoAkhirKasQurban::first();
            if ($saldoKas) {
                // Jika saldo kas ada, perbarui saldo_akhir
                $saldoKas->update(['saldo_akhir' => $saldoAkhir]);
            } else {
                $kas = [
                    'saldo_akhir' => $saldoAkhir,
                    'created_by' => Auth()->user()->id
                ];
                saldoAkhirKasQurban::create($kas);
            }
            $revenue = kas::GetRevenue();
            $expense = kas::GetExpense();
            event(new SaldoAkhirKas($saldoAkhir, $revenue, $expense));
    }

    /**
     * Handle the kas "updated" event.
     */
    public function updated(kas $kas): void
    {
        // Periksa apakah data ditemukan
        $data = kas::find($kas->id);
        $nilaiawal = $kas->initialAmount;
        $saldoAkhir = kas::SaldoAkhir();
        if ($data) {
            if ($data->jenis == 'masuk') {
                $saldoAkhir -= $nilaiawal;
                $saldoAkhir += $data->jumlah;
            } 
            if ($data->jenis == 'keluar') {
                $saldoAkhir += $nilaiawal;
                $saldoAkhir -= $kas->jumlah; 
            }
            // Update data
            $saldoKas = saldoAkhirKasQurban::first();
            $saldoKas->update(['saldo_akhir' => $saldoAkhir]);
        }
        $revenue = kas::GetRevenue();
        $expense = kas::GetExpense();
        event(new SaldoAkhirKas($saldoAkhir, $revenue, $expense));
    }

    /**
     * Handle the kas "deleted" event.
     */
    public function deleted(kas $kas): void
    {
        //
    }

    /**
     * Handle the kas "restored" event.
     */
    public function restored(kas $kas): void
    {
        //
    }

    /**
     * Handle the kas "force deleted" event.
     */
    public function forceDeleted(kas $kas): void
    {
        //
    }
}
