<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\hewan;
use App\Models\jenis;
use App\Models\kelompok;
use App\Models\penerima;
use App\Models\salurDaging;
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

        $distribusi = salurDaging::with('jenis')->get();
        // $qkel = DB::table('kelompoks')->select('kelompok')->get();
        $data = [
            'shohibul' => shohibul::orderBy('id', 'desc')->limit(5)->get(),
            'penerima' => penerima::count(),
            'kelompok' => kelompok::count(),
            'klpk'     => kelompok::select('kelompok')->get(),
            'groupByJenis' => $distribusi->groupBy('jenis.nama_jenis'),
            // 'totalsapi' => DB::table('shohibuls as a')
            // ->select('a.id_hewan')
            // ->join('hewans as b', 'a.id_hewan','=','b.id')
            // ->join('jenis as c','c.id','=','b.id_jenis')
            // ->where('c.id','=', 1)
            // ->groupBy('a.id_hewan')
            // ->orderBy('a.id_hewan', 'DESC')
            // ->limit(1)
            // ->get(),
            'totalsapi' => DB::table('hewans')
            ->where('id_jenis', 1)
            ->count('id_jenis'),
            'totalkambing' => DB::table('hewans')
            ->where('id_jenis', 2)
            ->count('id_jenis'), 
            // 'distribusi' => DB::table('salur_dagings as a')
            //              ->select('a.penerima', 'b.nama_jenis','a.jumlah', 'a.berat', DB::raw('a.jumlah * a.berat as Total'))
            //              ->join('jenis as b', 'a.id_jenis_daging','=','b.id')
            //              ->get()
        ];
        // dd($data['groupByJenis']);
        // $data['klpk'] = $qkel;
        $data['type'] = $type;
        // dd($data['klpk']);
        return view('frontend.dashboard.index', $data);
    }

    public function shohibulDetail(Request $request)
    {
        if (request()->ajax()) {
            $jenis = $request->jenis;
            $kelompok = $request->kelompok;

            $query = DB::table('shohibuls as a')
                ->select('a.nama', 'a.alamat', 'a.telp', 'b.nama_hewan', 'c.nama_jenis')
                ->join('hewans as b', 'a.id_hewan', '=', 'b.id')
                ->join('jenis as c', 'b.id_jenis', '=', 'c.id');

            if ($jenis != 'all') {
                $query->where('c.id', '=', $jenis);
            }

            if ($kelompok != 'all') {
                $query->where('b.id', '=', $kelompok);
            }

            $data = $query->get();

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
         // Query untuk mendapatkan data shohibul dan hewan yang berhubungan
         $kelompok = DB::table('shohibuls as a')
         ->select('b.id', 'b.nama_hewan', 'b.foto', DB::raw('GROUP_CONCAT(a.nama) as shohibul_names'))
         ->join('hewans as b', 'a.id_hewan', '=', 'b.id')
         ->join('jenis as c', 'c.id', '=', 'b.id_jenis')
         ->where('c.id', 1)
         ->groupBy('b.id', 'b.nama_hewan', 'b.foto')
         ->get();
         $title = 'Kelompok Qurban Sapi';
         return view('frontend.dashboard.groupSapi', compact('kelompok','title'));
        }
        
        public function groupKambing()
        {
            // Query untuk mendapatkan data shohibul dan hewan yang berhubungan
            $kelompok = DB::table('shohibuls as a')
            ->select('b.id', 'b.nama_hewan', 'b.foto', DB::raw('GROUP_CONCAT(a.nama) as shohibul_names'))
            ->join('hewans as b', 'a.id_hewan', '=', 'b.id')
            ->join('jenis as c', 'c.id', '=', 'b.id_jenis')
            ->where('c.id', 2)
            ->groupBy('b.id', 'b.nama_hewan', 'b.foto')
            ->get();
            $title = 'Kelompok Qurban Kambing';

        return view('frontend.dashboard.groupSapi', compact('kelompok','title'));
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
            $query = DB::table('penerimas')
            ->select('nama','alamat','type');
            
            if ($kelompok != 'all') {
                $query->where('id_klp', '=', $kelompok);
            }
            $data = $query->get();

            return DataTables::of($data)->addIndexColumn()->make();
        }
        $dt = [
            'kelompok' => kelompok::get()
        ];
        return view('frontend.dashboard.warga', $dt);
    }
}
