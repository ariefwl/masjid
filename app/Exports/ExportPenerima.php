<?php

namespace App\Exports;

use App\Models\penerima;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportPenerima implements FromView, WithStyles
{
    use Exportable;
    public $klp,$koor,$id;

    public function __construct($idKlp, $klmpk, $kor)
    {
        $this->klp = $klmpk;
        $this->koor = $kor;
        $this->id = $idKlp;
    }

    public function view(): View
    {
        if ($this->id == 'all') {
            $dt = penerima::get();
        } else {
            $dt = penerima::where('id_klp', $this->id)->get();
        }
        $data = [
            'penerima' => $dt,
            'kelompok' => $this->klp,
            'koordinator' => $this->koor
        ];
        // dd($data);
        return view('backend.takmir.upq.penerima.report', $data);
    }

    public function styles(Worksheet $sheet)
    {
        $kop = [
                'font' => [
                    'bold' => true,
                    'size' => 16,
                    'name' => 'Tahoma'
                ]
            ];
        return [
            'A1:A2' => $kop
        ];
    }
}
