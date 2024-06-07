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
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        
        $klp = kelompok::select('id')->count();
        for ($i=1; $i <= $klp ; $i++) { 
            $query = DB::table('penerimas')
                        ->selectRaw("SUM(CASE WHEN type = '1' AND id_klp = '".$i."' THEN 1 ELSE 0 END) as non")
                        ->selectRaw("SUM(CASE WHEN type = '0' AND id_klp = '".$i."' THEN 1 ELSE 0 END) as mus")
                        ->first();
            $type[] = $query;
        };
        // $qkel = DB::table('kelompoks')->select('kelompok')->get();
        $data = [
            'shohibul' => shohibul::orderBy('id', 'desc')->limit(5)->get(),
            'penerima' => penerima::count(),
            'kelompok' => kelompok::count(),
            'klpk'     => kelompok::select('kelompok')->get(),
            'totalsapi' => DB::table('shohibuls as a')
            ->select('a.id_hewan')
            ->join('hewans as b', 'a.id_hewan','=','b.id')
            ->join('jenis as c','c.id','=','b.id_jenis')
            ->where('c.id','=', 1)
            ->groupBy('a.id_hewan')
            ->orderBy('a.id_hewan', 'DESC')
            ->limit(1)
            ->get(),
        ];
        // $data['klpk'] = $qkel;
        $data['type'] = $type;
        // dd($data['klpk']);
        // dd($data['totalsapi'][0]->{'id_hewan'});
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

    public function kelompok(Request $request)
    {
        if (request()->ajax()) {
            $data = DB::table('kelompoks') 
                ->select('kelompok','koordinator','telp','alamat')
                ->get();

            return DataTables::of($data)->addIndexColumn()->make();
        }
        return view('frontend.dashboard.kelompok');
    }

    public function warga(Request $request)
    {
        if (request()->ajax()) {
            $kelompok = $request->kelompok;
            $data = DB::table('penerimas')
            ->select('nama','alamat','type')
            ->get();

            return DataTables::of($data)->addIndexColumn()->make();
        }
        $dt = [
            'kelompok' => kelompok::get()
        ];
        return view('frontend.dashboard.warga', $dt);
    }
}
