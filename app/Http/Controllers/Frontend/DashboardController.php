<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\kelompok;
use App\Models\penerima;
use App\Models\shohibul;
use Illuminate\Http\Request;
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
            if ($jenis == 'all') {
                $data = shohibul::get();
            } else {
                $data = shohibul::where('jenis', $jenis)->get();
            }

            return DataTables::of($data)
                   ->addIndexColumn()
                   ->make();
        }
        return view('frontend.dashboard.shohibulDetail');
    }

    public function groupSapi()
    {
        $data = [
            'shohibul' => shohibul::get()
        ];
        return view('frontend.dashboard.groupSapi');
    }
}
