<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\profileMasjid;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'masjid'=>profileMasjid::all()
        ];
        // dd($data['masjid'][0]['nama']);
        return view('backend.profile.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validasi data jika diperlukan
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email',
            'logo' => 'image|mimes:jpeg,png,jpg,bmp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $gbr = $request->file('logo');
            $gbrname = 'logo.'.$gbr->getClientOriginalExtension();
            $gbr->move(public_path('Image'), $gbrname);
        } else {
            $gbr = null;
        }
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'logo' => $gbrname
        ];
        profileMasjid::create($data);
        return response()->json(['success' => 'Data kelompok berhasil di tambahkan !']);
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
