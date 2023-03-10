<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masyarakat = Masyarakat::get();
        return view('VMasyarakat', compact('masyarakat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required',
            'password' => 'required',
            'telp' => 'required',
        ]);

        $input = $request->all();

        Masyarakat::create($input);

        return redirect()->route('masyarakat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function show(Masyarakat $id)
    {
        $masyarakat = Masyarakat::where('id', $id)->first();
        if ($masyarakat) {
            return view('VMasyarakat', compact('masyarakat'));
        } else {
            return response()->view(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function edit(Masyarakat $masyarakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required',
            'telp' => 'required',
        ]);
        $input = $request->except(['_token', '_method' ]);

        Masyarakat::where('id_user', $id)->update($input);

        return redirect()->route('masyarakat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Masyarakat::where('id_user', $id)->delete();
     
        return redirect()->route('masyarakat.index');
    }
}
