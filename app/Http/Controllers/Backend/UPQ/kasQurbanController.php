<?php

namespace App\Http\Controllers\Backend\UPQ;

use App\Http\Controllers\Controller;
use App\Models\kas;
use App\Models\saldoAkhirKasQurban;
use Carbon\Carbon;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Events\SaldoAkhirKas;

class kasQurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            // Konversi tanggal ke format 'Y-m-d'
            $awal = date('Y-m-d', strtotime($request->tgl_awal));
            $akhir = date('Y-m-d', strtotime($request->tgl_akhir));

            if (!empty($request->tgl_awal)) {
                $data = kas::whereBetween('tanggal', [$awal, $akhir])
                ->orderBy('created_at', 'desc')
                ->get();
            } else {
                $data = kas::orderBy('created_at', 'desc')->get();
            }
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
        
        $tglTrans = Carbon::createFromFormat('d-m-Y', $request->tanggal);
        $thnBulanTrans = $tglTrans->format('Ym');
        $thnBulanSekarang = Carbon::now()->format('Ym');
        if ($thnBulanTrans != $thnBulanSekarang) {
            return response()->json(['msg' => 'tglOffSide']);
        } else {
            // // Periksa apakah data ditemukan
            $data = kas::find($id);
            $data->controllerId = $id;
            $data->nilaiawal = $data->jumlah;
            $data->update([
                'tanggal' => Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d'),
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan,
                'jumlah' => $request->jumlah,
                // 'jenis' => $request->jenis,
            ]);

            // Kembalikan response JSON dengan status berhasil
            return response()->json($data, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getSaldoAkhir()
    {
        $data = saldoAkhirKasQurban::latest()->value('saldo_akhir');
        // dd($data);
        return response()->json(['saldo_akhir'=>$data]);
    }

    public function cetakLap($tgl_awal, $tgl_akhir)
    {
        // Konversi tanggal ke format 'Y-m-d'
        $awal = date('Y-m-d', strtotime($tgl_awal));
        $akhir = date('Y-m-d', strtotime($tgl_akhir));

        $kasRecords = kas::whereBetween('tanggal', [$awal, $akhir])->orderBy('tanggal', 'asc')->get();
        // Calculate saldo awal (initial balance)
        $saldoAwal = 1000000; // Example initial balance, adjust as needed

        // Initialize arrays for masuk and keluar
        $masuk = [];
        $keluar = [];
        $totalMasuk = 0;
        $totalKeluar = 0;

        // Process records
        foreach ($kasRecords as $index => $record) {
            if ($record->jenis == 'masuk') {
                $masuk[] = $record;
                $totalMasuk += $record->jumlah;
            } else {
                $keluar[] = $record;
                $totalKeluar += $record->jumlah;
            }
        }

        // Calculate saldo akhir (ending balance)
        $saldoAkhir = $saldoAwal + $totalMasuk - $totalKeluar;
        return view('backend/takmir/upq/kas/laporan', compact('tgl_awal','tgl_akhir','masuk','keluar','totalMasuk','totalKeluar','saldoAwal','saldoAkhir'));
    }
}
