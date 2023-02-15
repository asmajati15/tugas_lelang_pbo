<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Lelang;

class HistoryController extends Controller
{
    public function index()
    {
        $lelang = Lelang::get();
        $history = History::get();
        return view('VHistory', compact('history','lelang'));
    }
    public function store(Request $request)
    {
        try {
            History::insert([
                'id_lelang' => $request->id_lelang,
                'id_user' => $request->id_user,
                'penawaran_harga' => $request->penawaran_harga
            ]);
            return redirect()->back()->with(['message'=>'data berhasil di update','status'=>'success']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['message'=>'data berhasil di gagal '.$ex->getMessage(),'status'=>'error']);
            //throw $th;
        }
    }
}
