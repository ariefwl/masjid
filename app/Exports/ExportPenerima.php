<?php

namespace App\Exports;

use App\Models\penerima;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPenerima implements FromView
{
    use Exportable;
    public $klp;

    public function __construct($klp)
    {
        $this->klp = $klp;
    }

    public function view(): View
    {
        if ($this->klp == 'all') {
            $dt = penerima::get();
        } else {
            $dt = penerima::where('id_klp', $this->klp)->get();
        }
        $data = [
            'penerima' => $dt,
            'kelompok' => $this->klp
        ];
        // dd($data);
        return view('backend.upq.penerima.report', $data);
    }
}
