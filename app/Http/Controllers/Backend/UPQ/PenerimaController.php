<?php

namespace App\Http\Controllers\Backend\UPQ;

use App\Exports\ExportPenerima;
use App\Http\Controllers\Controller;
use App\Imports\ImportPenerima;
use App\Models\kelompok;
use App\Models\penerima;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $kelompok = $request->kelompok;
            if ($kelompok == 'all') {
                $data = penerima::get();
            } else {
                $data = penerima::where('id_klp', $kelompok)->get();
            }
            // dd($data);
            return DataTables::of($data)
                   ->addIndexColumn()
                   ->addColumn('button', function($data){
                       return '<div class="text-center">
                                   <a href="artikel/'.$data->id.'/edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                                   <a href="#" onclick="deleteArtikel(this)" data-id="'.$data->id.'" class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></a>
                                   <button class="btn btn-sm btn-danger" id="test">test</button>
                               </div>';
                   })
                   ->rawColumns(['button'])
                   ->make();
        }
        $data = [
            'kelompok' => kelompok::all()->pluck('id','kelompok')
        ];
        return view('backend.takmir.upq.penerima.index', $data);
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

    public function export_excel(Request $request)
    {
        $idKlp = $request->kelompok;
        $klp = kelompok::where('id', $idKlp)->get();
        $klmpk = $klp[0]['kelompok']; 
        $kor = $klp[0]['koordinator'];
        // dd($klp[0]['koordinator']);
        return Excel::download(new ExportPenerima($idKlp, $klmpk, $kor), 'penerima.xlsx', null, [\Maatwebsite\Excel\Excel::XLSX]);
    }

    public function importData(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        
        Excel::import(new ImportPenerima, $request->file('file'));

        // Filter duplicate entries
        $uniqueData = penerima::select('id_klp', 'nama', 'alamat', 'type', 'status')
                          ->distinct()
                          ->get();
        
        // Clear the table and re-insert unique data
        penerima::truncate();
        foreach ($uniqueData as $data) {
            penerima::create($data->toArray());
        }

        return redirect('/penerima')->with('success', 'Data berhasil di upload !');
    }
}
