<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klasemen;

class KlasemenController extends Controller
{
    public function index()
    {
       
        $klasemen = Klasemen::orderBy('poin', 'desc')->get();
        return view('klasemen.index')->with('klasemen', $klasemen);
        
    }

}
