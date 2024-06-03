<?php

namespace App\Imports;

use App\Models\penerima;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportPenerima implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd($row);
        return new penerima([
            'id_klp' => $row['id_klp'],
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'type' => $row['type'],
            'status' => $row['status']
        ]);
    }
}
