<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\kelompok;
use App\Models\penerima;
use App\Models\shohibul;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'shohibul' => shohibul::orderBy('id', 'desc')->limit(5)->get(),
            'penerima' => penerima::count(),
            'kelompok' => kelompok::count()
        ];
        return view('frontend.dashboard.index', $data);
    }
}
