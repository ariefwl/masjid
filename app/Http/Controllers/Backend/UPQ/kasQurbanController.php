<?php

namespace App\Http\Controllers\Backend\UPQ;

use App\Http\Controllers\Controller;
use App\Models\kas;
use Carbon\Carbon;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class kasQurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = kas::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('jumlah', function ($data) {
                    return formatRupiah($data->jumlah);
                })
                ->addColumn('tanggal', function ($data) {
                    return ($data->tanggal->translatedFormat('d-m-Y'));
                })
                ->addColumn('pemasukan', function ($data) {
                    return $data->jenis == 'masuk' ? formatRupiah($data->jumlah) : '-';
                })
                ->addColumn('pengeluaran', function ($data) {
                    return $data->jenis == 'keluar' ? formatRupiah($data->jumlah) : '-';
                })
                ->addColumn('nama', function($data) {
                    return $data->createdBy->name;
                })
                ->addColumn('button', function ($data) {
                    return '
                        <div class="btn-group">
                            <button onclick="edit(`' . route('kasQurban.update', $data->id) . '`)" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                            <!-- <button onclick="edit(`' . route('kelompok.update', $data->id) . '`)" class="btn btn-danger btn-sm"><i class="bi bi-pencil-square"></i></button> -->
                        </div>
                        ';
                })
                ->rawColumns(['button'])
                ->make();
        }
        $saldoAkhir = kas::SaldoAkhir();
        return view('backend.takmir.upq.kas.index', compact('saldoAkhir'));
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
        $data = $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|numeric',
        ]);
        $tglTrans = Carbon::createFromFormat('d-m-Y', $request->tanggal);
        $thnBulanTrans = $tglTrans->format('Ym');
        $thnBulanSekarang = Carbon::now()->format('Ym');
        if ($thnBulanTrans != $thnBulanSekarang) {
            return response()->json(['msg' => 'tglOffSide']);
        } else {
            // $saldoAkhir = kas::SaldoAkhir();
            
            // saldo akhir ditambah transaksi masuk/keluar
            // if ($data['jenis'] == 'masuk') {
            //     $saldoAkhir += $data['jumlah'];
            // } else {
            //     $saldoAkhir -= $data['jumlah'];
            // }

            // if ($saldoAkhir <= -1) {
            //     return response()->json(['msg' => 'gagal']);
            // }

            // $kas = new kas();
            // $kas->fill($data);
            // $kas->saldo_akhir = $saldoAkhir;
            // dd($kas);
            // $kas->save();
            $data = [
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d'),
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan,
                'jenis' => $request->jenis,
                'jumlah' => $request->jumlah,
                'created_by' => Auth()->user()->id
            ];
            kas::create($data);
            return response()->json();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = kas::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $kas = kas::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = kas::find($id);
        // Periksa apakah data ditemukan
        if ($data) {
            // Update data
            $data->update([
                'keterangan' => $request->keterangan,
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
