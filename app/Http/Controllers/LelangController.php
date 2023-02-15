<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use Illuminate\Http\Request;

class LelangController extends Controller
{
    public function index()
    {
        $lelang = Lelang::get();
        return view('VLelang', compact('lelang'));
    }

}