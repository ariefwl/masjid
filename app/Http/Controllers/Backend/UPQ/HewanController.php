<?php

namespace App\Http\Controllers\Backend\UPQ;

use App\Http\Controllers\Controller;
use App\Models\hewan;
use App\Models\jenis;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $jenis = $request->jenis;
            $data = hewan::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('button',function($data){
                        return '<div class="text-center">
                                <button onclick="edit(`'. route('kelompok.update', $data->id) .'`)" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button>
                                </div>';
                    })
                    ->rawColumns(['button'])
                    ->make();
        }
        $kategori = jenis::get();
        return view('backend.takmir.upq.hewan.index', compact('kategori'));
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
        $validasi = Validator::make($request->all(),[
            'gbr' => 'image|mimes:jpeg,png,jpg,bmp|max:2048'
        ]);

        if ($request->hasFile('gbr')) {
            $gbr = $request->file('gbr');
            $gbrname = date('YmdHis') . '.' . $gbr->getClientOriginalExtension();
            $gbr->move(public_path('Image/qurban/1445H'), $gbrname);
            $data = new hewan(); 
            $data->id_jenis = $request->input('kategori');
            $data->nama_hewan = $request->input('nama');
            $data->umur = $request->input('umur');
            $data->bobot = $request->input('bobot');
            $data->foto = $gbrname;
            // dd($data);
            $data->save();
    
            return response()->json(['success' => 'Data berhasil disimpan.']);
        }
        return response()->json(['success' => 'Data tidak bisa di simpan !.']);
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
