<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Skor;
use App\Models\Klub;
use App\Models\Klasemen;


class SkorController extends Controller
{

    public function index()
    {

        $skor = Skor::orderBy('created_at', 'desc')->get();

        return view('skor.index')->with('skor', $skor);
        
    }

    public function create()
    {
        $klub = Klub::all();
        return view('skor.tambah_skor')->with('klub', $klub);
       
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'inputs.*.klub_id' => [
                'required',
                Rule::unique('skor')->where(function ($query) use ($request) {
                    return $query->where('klub_id_lawan', $request->input('inputs.*.klub_id_lawan'));
                }),
            ],
            'inputs.*.skor' => 'required',
            'inputs.*.klub_id_lawan' => [
                'required',
                Rule::unique('skor')->where(function ($query) use ($request) {
                    return $query->where('klub_id', $request->input('inputs.*.klub_id'));
                }),
            ],
            'inputs.*.skor_lawan' => 'required',
        ], [
            'inputs.*.klub_id.required' => 'Nama klub wajib diisi',
            'inputs.*.skor.required' => 'Skor wajib diisi',
            'inputs.*.klub_id_lawan.required' => 'Nama klub lawan wajib diisi',
            'inputs.*.skor_lawan.required' => 'Skor lawan wajib diisi',
            'inputs.*.klub_id.unique' => 'Pertandingan dengan klub ini dan lawan klub ini sudah terdaftar',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        
        
        foreach ($request->inputs as $key => $value) { 

            //insert skor
            $skor = Skor::create([
                'klub_id'       => $value['klub_id'],
                'skor'          => $value['skor'],
                'klub_id_lawan' => $value['klub_id_lawan'],
                'skor_lawan'    => $value['skor_lawan'],
               
            ]);
        
            // klub id
            $klubId = $value['klub_id'];
            $klubIdLawan = $value['klub_id_lawan'];

            //skor klub
            $klubSkor = $value['skor'];
            $klubSkorLawan = $value['skor_lawan'];
        
            //penanganan klasement
            $klasemenMA = Klasemen::where('klub_id', $klubId)->first();
            $klasemenMALawan = Klasemen::where('klub_id', $klubIdLawan)->first();
        
            if ($klasemenMA && $klasemenMA->MA > 0 && $klasemenMALawan && $klasemenMALawan->MA > 0) {
                $klasemenUpdates = ['MA' => $klasemenMA->MA + 1];
        
                if ($klubSkor > $klubSkorLawan) {
                    $klasemenUpdates['ME'] = $klasemenMA->ME + 1;
                    $klasemenUpdates['GM'] = $klasemenMA->GM + $klubSkor;
                    $klasemenUpdates['poin'] = $klasemenMA->poin + 3;
                } elseif ($klubSkor == $klubSkorLawan) {
                    $klasemenUpdates['S'] = $klasemenMA->S + 1;
                    $klasemenUpdates['poin'] = $klasemenMA->poin + 1;
                } else {
                    $klasemenUpdates['K'] = $klasemenMA->K + 1;
                    $klasemenUpdates['GK'] = $klasemenMA->GK + $klubSkor;
                }
        
                $klasemenMA->update($klasemenUpdates);
        
                // lawan
                $klasemenUpdatesLawan = ['MA' => $klasemenMALawan->MA + 1];
        
                if ($klubSkor > $klubSkorLawan) {
                    $klasemenUpdatesLawan['K'] = $klasemenMALawan->K + 1;
                    $klasemenUpdatesLawan['GK'] = $klasemenMALawan->GK + $klubSkorLawan;
                } elseif ($klubSkor == $klubSkorLawan) {
                    $klasemenUpdatesLawan['S'] = $klasemenMA->S + 1;
                    $klasemenUpdatesLawan['poin'] = $klasemenMALawan->poin + 1;
                } else {
                    $klasemenUpdatesLawan['ME'] = $klasemenMALawan->ME + 1;
                    $klasemenUpdatesLawan['GM'] = $klasemenMALawan->GM + $klubSkorLawan;
                    $klasemenUpdatesLawan['poin'] = $klasemenMALawan->poin + 3;
                }
        
                $klasemenMALawan->update($klasemenUpdatesLawan);

            } elseif (!$klasemenMA && !$klasemenMALawan) {
                
                $klasemenMA = Klasemen::create([
                    'klub_id' => $klubId,
                    'MA' => 1,
                ]);
        
                if ($klubSkor > $klubSkorLawan) {
                    $klasemenMA->update([
                        'ME' => $klasemenMA->ME + 1,
                        'GM' => $klasemenMA->GM + $klubSkor,
                        'poin' => $klasemenMA->poin + 3
                    ]);
                } elseif ($klubSkor == $klubSkorLawan) {
                    $klasemenMA->update([
                        'S' => $klasemenMA->S + 1,
                        'poin' => $klasemenMA->poin + 1
                    ]);
                } else {
                    $klasemenMA->update([
                        'K' => $klasemenMA->K + 1,
                        'GK' => $klasemenMA->GK + $klubSkor
                    ]);
                }
        
                // lawan
                $klasemenMALawan = Klasemen::create([
                    'klub_id' => $klubIdLawan,
                    'MA' => 1,
                ]);
        
                if ($klubSkor > $klubSkorLawan) {
                    $klasemenMALawan->update([
                        'K' => $klasemenMALawan->K + 1,
                        'GK' => $klasemenMALawan->GK + $klubSkorLawan,
                    ]);
                } elseif ($klubSkor == $klubSkorLawan) {
                    $klasemenMALawan->update([
                        'S' => $klasemenMALawan->S + 1,
                        'poin' => $klasemenMALawan->poin + 1
                    ]);
                } else {
                    $klasemenMALawan->update([
                        'ME' => $klasemenMALawan->ME + 1,
                        'GM' => $klasemenMALawan->GM + $klubSkorLawan,
                        'poin' => $klasemenMALawan->poin + 3
                    ]);
                }
            } elseif ($klasemenMA && !$klasemenMALawan) {
                $klasemenUpdates = ['MA' => $klasemenMA->MA + 1];
        
                if ($klubSkor > $klubSkorLawan) {
                    $klasemenUpdates['ME'] = $klasemenMA->ME + 1;
                    $klasemenUpdates['GM'] = $klasemenMA->GM + $klubSkor;
                    $klasemenUpdates['poin'] = $klasemenMA->poin + 3;
                } elseif ($klubSkor == $klubSkorLawan) {
                    $klasemenUpdates['S'] = $klasemenMA->S + 1;
                    $klasemenUpdates['poin'] = $klasemenMA->poin + 1;
                } else {
                    $klasemenUpdates['K'] = $klasemenMA->K + 1;
                    $klasemenUpdates['GK'] = $klasemenMA->GK + $klubSkor;
                }
        
                $klasemenMA->update($klasemenUpdates);

                // lawan
                $klasemenMALawan = Klasemen::create([
                    'klub_id' => $klubIdLawan,
                    'MA' => 1,
                ]);
        
                if ($klubSkor > $klubSkorLawan) {
                    $klasemenMALawan->update([
                        'K' => $klasemenMALawan->K + 1,
                        'GK' => $klasemenMALawan->GK + $klubSkorLawan,
                    ]);
                } elseif ($klubSkor == $klubSkorLawan) {
                    $klasemenMALawan->update([
                        'S' => $klasemenMALawan->S + 1,
                        'poin' => $klasemenMALawan->poin + 1
                    ]);
                } else {
                    $klasemenMALawan->update([
                        'ME' => $klasemenMALawan->ME + 1,
                        'GM' => $klasemenMALawan->GM + $klubSkorLawan,
                        'poin' => $klasemenMALawan->poin + 3
                    ]);
                }
            } elseif (!$klasemenMA && $klasemenMALawan) {
                $klasemenMA = Klasemen::create([
                    'klub_id' => $klubId,
                    'MA' => 1,
                ]);
        
                if ($klubSkor > $klubSkorLawan) {
                    $klasemenMA->update([
                        'K' => $klasemenMA->K + 1,
                        'GK' => $klasemenMA->GK + $klubSkorLawan,
                    ]);
                } elseif ($klubSkor == $klubSkorLawan) {
                    $klasemenMA->update([
                        'S' => $klasemenMA->S + 1,
                        'poin' => $klasemenMA->poin + 1
                    ]);
                } else {
                    $klasemenMA->update([
                        'ME' => $klasemenMA->ME + 1,
                        'GM' => $klasemenMA->GM + $klubSkorLawan,
                        'poin' => $klasemenMA->poin + 3
                    ]);
                }
        
                // lawan
                $klasemenUpdates = ['MA' => $klasemenMALawan->MA + 1];
        
                if ($klubSkor > $klubSkorLawan) {
                    $klasemenUpdates['ME'] = $klasemenMALawan->ME + 1;
                    $klasemenUpdates['GM'] = $klasemenMALawan->GM + $klubSkor;
                } elseif ($klubSkor == $klubSkorLawan) {
                    $klasemenUpdates['S'] = $klasemenMALawan->S + 1;
                    $klasemenUpdates['poin'] = $klasemenMALawan->poin + 1;
                } else {
                    $klasemenUpdates['K'] = $klasemenMALawan->K + 1;
                    $klasemenUpdates['GK'] = $klasemenMALawan->GK + $klubSkor;
                    $klasemenUpdates['poin'] = $klasemenMALawan->poin + 3;
                }
        
                $klasemenMALawan->update($klasemenUpdates);
            }

          
        }

        $request->session()->flash('success', 'Skor Berhasil ditambahkan');
        
        return redirect('/skor');
    }

}
