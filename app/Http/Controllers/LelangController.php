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
        $lelang = Lelang::with('barang')->get();
        $barang = Barang::with('lelang')->get();
        return view('VLelang', compact('lelang', 'barang'));
    }

    public function newBids(Request $request, $id_barang)
    {
        // $request->validate([
        //     'bid_price' => 'required',
        // ]);

        Lelang::create([
            'harga_akhir' => $request->harga_akhir,
            'id_barang' => $id_barang,
            'id_user' => Auth::id(),
            'status_lelang' => '1',
        ]);

        return redirect()->route('lelang.index')->with('success', 'Product created successfully.');
    }
}
