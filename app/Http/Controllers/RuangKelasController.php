<?php

namespace App\Http\Controllers;

use App\Models\RuangKelas;
use Illuminate\Http\Request;

class RuangKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = RuangKelas::orderBy('lokasi', 'desc')
                ->orderBy('kode', 'asc')
                ->get();
        return view('ruangkelas.index', ['ruangkelas' => $kelas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ruangkelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'lokasi' => 'required',
            'kode' => 'required|max:10',
        ]);
        $formFields['kode'] = strtoupper($formFields['kode']);
        
        RuangKelas::create($formFields);
        return redirect()->route('ruangkelas.index')->with('message', 'Kelas berhasil ditambah');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RuangKelas  $ruangKelas
     * @return \Illuminate\Http\Response
     */
    public function show(RuangKelas $ruangKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RuangKelas  $ruangKelas
     * @return \Illuminate\Http\Response
     */
    public function edit(RuangKelas $ruangKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RuangKelas  $ruangKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RuangKelas $ruangKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RuangKelas  $ruangKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(RuangKelas $ruangKelas)
    {
        //
    }
}
