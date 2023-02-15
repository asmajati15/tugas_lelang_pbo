<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class LelangController extends Controller
{
    public function index()
    {
        $lelang = Lelang::get();
        $barang = Barang::get();
        return view('VLelang', compact('lelang', 'barang'));
    }

    public function newBids(Request $request, Barang $id_barang)
    {
        Lelang::create([
            'harga_akhir' => $request->harga_akhir,
            'id_barang' => $id_barang,
            'id_user' => Auth::id(),
            'status_lelang' => '1',
        ]);

        return redirect()->route('lelang.index')->with('success', 'Product created successfully.');
    }
}
