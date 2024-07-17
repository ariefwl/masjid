<?php

namespace App\Http\Controllers\Backend;

use App\Events\SaldoAkhirKas;
use App\Http\Controllers\Controller;
use App\Models\kas;
use App\Models\saldoAkhirKasQurban;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $unit = Auth()->user()->unit;
        if ($unit == '3') {
            $data = [
                'unit' => 'Panitia Qurban',
            ];
        } if ($unit == '2') {
            $data = [
                'unit' => 'Unit Pengelola Zakat',
            ]; 
        }
        return view('backend.dashboard', $data);
    }

    public function getSaldoKasQurban()
    {
        $data = saldoAkhirKasQurban::first();
        // dd($data[0]['saldo_akhir']);
        // $data = SaldoAkhirKas();
        return response()->json(['data'=>$data]);
    }

    public function getRevenue()
    {
        $data = DB::table('kas_qurban')
                ->where('jenis', 'masuk')
                ->where('created_at', 'like', '2024%')
                ->sum('jumlah');
        return response()->json(['data' => $data]);
    }

    public function getExpense()
    {
        $data = DB::table('kas_qurban')
                ->where('jenis', 'keluar')
                ->where('created_at', 'like', '2024%')
                ->sum('jumlah');
        return response()->json(['data' => $data]);
    }
}
