<?php

namespace App\Http\Controllers\Backend\UPQ;

use App\Http\Controllers\Controller;
use App\Models\hewan;
use App\Models\jenis;
use App\Models\shohibul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use function Laravel\Prompts\alert;

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
                ->select('a.id','a.nama', 'a.alamat', 'a.telp', 'a.type', 'a.permintaan', 'b.nama_hewan', 'c.nama_jenis')
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
                       return '<div class="btn-group">
                                   <button onclick="edit(`'. route('shohibul.update', $data->id) .'`)" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>

                                   <button onclick="ceta('.$data->id.')" class="btn btn-success btn-sm"><i class="bi bi-printer"></i></button>
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
        $shohibul = DB::table('shohibuls as a')
                    ->select('a.nama','a.alamat','a.permintaan','b.nama_hewan')
                    ->join('hewans as b', 'a.id_hewan','=', 'b.id')
                    ->get();
        // dd($shohibul);
        return view('backend.takmir.upq.shohibul.tandaterima', compact('shohibul'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_hewan' => $request->id_hewan,
            'telp' => $request->telepon,
            'permintaan' => $request->permintaan,
            'type' => $request->type,
        ];
        shohibul::create($data);
        return response()->json();
    }

    public function cetakUndangan()
    {
        dd('Undangan');
    }

    // public function cetak()
    // {
    //     return view('backend.takmir.upq.shohibul.tandaterima');
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = shohibul::find($id);
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
        // Validasi data jika diperlukan
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'id_hewan' => 'required|integer',
        'telepon' => 'required|string|max:15',
        'type' => 'required|string|max:50',
        'permintaan' => 'required|string|max:255',
    ]);

    // Temukan data berdasarkan ID
    $data = Shohibul::find($id);
    
    // Periksa apakah data ditemukan
    if ($data) {
        // Update data
        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'id_hewan' => $request->id_hewan,
            'telepon' => $request->telepon,
            'type' => $request->type,
            'permintaan' => $request->permintaan,
        ]);

        // Kembalikan response JSON dengan status berhasil
        return response()->json($data, 200);
    } else {
        // Jika data tidak ditemukan, kembalikan response JSON dengan status tidak ditemukan
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
