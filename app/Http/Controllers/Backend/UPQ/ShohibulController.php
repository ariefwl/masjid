<?php

namespace App\Http\Controllers\Backend\UPQ;

use App\Http\Controllers\Controller;
use App\Models\hewan;
use App\Models\jenis;
use App\Models\shohibul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ShohibulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
                   ->addColumn('button', function($data){
                       return '<div class="text-center">
                                   <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                                   <a href="#" onclick="deleteArtikel(this)" data-id="" class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></a>
                               </div>';
                   })
                   ->rawColumns(['button'])
                   ->make();
        }
        $data = [
            'jenis' => jenis::get(),
            'kelompokSapi' => hewan::where('id_jenis', 1)->select('id','nama_hewan')->get(),
            'hewanQurban' => hewan::select('id','nama_hewan')->get()
        ];
        // dd($data);
        return view('backend.takmir.upq.shohibul.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
