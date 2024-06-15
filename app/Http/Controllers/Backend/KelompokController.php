<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\kelompok;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = kelompok::get();
            return DataTables::of($data)
                   ->addIndexColumn()
                   ->addColumn('button', function($data){
                       return '
                        <div class="btn-group">
                            <button onclick="edit(`'. route('kelompok.update', $data->id) .'`)" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                            <a href="#" onclick="deleteArtikel(this)" data-id="'.$data->id.'" class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></a>
                        </div>
                        ';
                   })
                   ->rawColumns(['button'])
                   ->make();
        }
        return view('backend.kelompok.index');
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
        $data = [
            'kelompok' => $request->kelompok,
            'koordinator' => $request->koordinator,
            'telp' => $request->telepon,
            'alamat' => $request->alamat
        ];
        // dd($data);
        Kelompok::create($data);
        return response()->json(['success' => 'Data kelompok berhasil di tambahkan !']);
        // return redirect(url('kelompok'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = kelompok::find($id);
        // dd($data);
        return response()->json($data);
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
        $data = kelompok::find($id);
        $data->update([
            'kelompok' => $request->kelompok,
            'koordinator' => $request->koordinator,
            'alamat' => $request->alamat,
            'telp' => $request->telepon
        ]);

        return response()->json(['success' => 'Data kelompok berhasil di tambahkan !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
