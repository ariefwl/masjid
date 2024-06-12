<?php

namespace App\Http\Controllers\Backend\UPQ;

use App\Http\Controllers\Controller;
use App\Models\hewan;
use Illuminate\Http\Request;
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
                                <button type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-star me-1"></i></button>
                                </div>';
                    })
                    ->rawColumns(['button'])
                    ->make();
        }
        return view('backend.takmir.upq.hewan.index');
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
}
