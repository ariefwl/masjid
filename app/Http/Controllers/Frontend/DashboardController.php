<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\hewan;
use App\Models\jenis;
use App\Models\kelompok;
use App\Models\penerima;
use App\Models\shohibul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'shohibul' => shohibul::orderBy('id', 'desc')->limit(5)->get(),
            'penerima' => penerima::count(),
            'kelompok' => kelompok::count()
        ];
        return view('frontend.dashboard.index', $data);
    }

    public function shohibulDetail(Request $request)
    {
        if (request()->ajax()) {
            $jenis = $request->jenis;
            $kelompok = $request->kelompok;

            if ($jenis == 'all' && $kelompok == 'all') {
                $data = DB::table('shohibuls as a')
                ->select('a.nama', 'a.alamat', 'a.telp', 'b.nama_hewan', 'c.nama_jenis')
                ->join('hewans as b','a.id_hewan','=','b.id')
                ->join('jenis as c','b.id_jenis','=','c.id')
                ->get();
            } else if ($jenis == '2') {
                $data = DB::table('shohibuls as a')
                ->select('a.nama', 'a.alamat', 'a.telp', 'b.nama_hewan', 'c.nama_jenis')
                ->join('hewans as b','a.id_hewan','=','b.id')
                ->join('jenis as c','b.id_jenis','=','c.id')
                ->where('c.id','=', 2)
                ->get();
            } else if ($jenis == '1' && $kelompok == 'all'){
                $data = DB::table('shohibuls as a')
                ->select('a.nama', 'a.alamat', 'a.telp', 'b.nama_hewan', 'c.nama_jenis')
                ->join('hewans as b','a.id_hewan','=','b.id')
                ->join('jenis as c','b.id_jenis','=','c.id')
                ->where('c.id','=', 1)
                // ->where('b.id', '=', $kelompok)
                ->get();
            } else {
                $data = DB::table('shohibuls as a')
                ->select('a.nama', 'a.alamat', 'a.telp', 'b.nama_hewan', 'c.nama_jenis')
                ->join('hewans as b','a.id_hewan','=','b.id')
                ->join('jenis as c','b.id_jenis','=','c.id')
                ->where('c.id','=', $jenis)
                ->where('b.id', '=', $kelompok)
                ->get();
            }
            
            // dd($data);
            return DataTables::of($data)
                   ->addIndexColumn()
                   ->make();
        }
        $dt = [
            'jenis' => jenis::get(),
            'kelompok' => hewan::where('id_jenis', 1)->get()
        ];
        return view('frontend.dashboard.shohibulDetail', $dt);
    }

    public function groupSapi()
    {
        $data = [
            'shohibul' => shohibul::get()
        ];
        return view('frontend.dashboard.groupSapi');
    }
}
