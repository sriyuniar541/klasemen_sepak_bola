<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klub;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class KlubController extends Controller 
{
   
    public function index()
    {
        // get kota
        $districts = District::all();
        
        // get klub
        $klub = Klub::orderBy('created_at', 'desc')->get();
        
        return view('klub.index')
            ->with('klub', $klub)
            ->with('districts', $districts);

        
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_klub'  => 'required|unique:klub,nama_klub',
            'kota_klub'  => 'required',
        ], 
        [
            'nama_klub.required'  => 'Nama_klub wajib diisi',
            'nama_klub.unique'    => 'Nama klub sudah pernah digunakan',
            'kota_klub.required'  => 'Kota wajib diisi',
        ]);

        $data = [
            'nama_klub'  =>  $request->nama_klub,
            'kota_klub'  =>  $request->kota_klub
        ];

    
       
        $klub = Klub::create($data); 
        
        $request->session()->flash('success', 'Klub Berhasil ditambahkan');
    
        return redirect ('/klub');

    }


}
