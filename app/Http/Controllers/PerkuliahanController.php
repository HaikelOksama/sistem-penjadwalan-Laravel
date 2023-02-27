<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenMatakuliah;
use App\Models\Matakuliah;
use App\Models\Perkuliahan;
use App\Models\RuangKelas;
use Illuminate\Http\Request;

class PerkuliahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perkuliahan = Perkuliahan::all();
        // $first = Perkuliahan::first();
        // $joined = $first->getFuck($first->id_dosen_matakuliah)->get();
        // dd($joined);
        return view('perkuliahan.index', ['perkuliahan' => $perkuliahan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = RuangKelas::all();
        $dosenMatkul = DosenMatakuliah::all();
        $dosen = Dosen::all();
        $matakuliah = Matakuliah::all();
        return view('perkuliahan.create', ['kelas' => $kelas, 'dosen' => $dosen , 'matakuliah' => $matakuliah]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $dosen = $request->input('dosen');
        $matkul = $request->input('matakuliah');
        $verifyDosen = Dosen::find($dosen);
        $verifyMatkul = $verifyDosen->matakuliah->find($matkul);
        if($verifyMatkul === null) {
            return back()->withInput($request->input())->with('error', 'Dosen tidak mengajar matkul');
        }
        dd($verifyMatkul);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perkuliahan  $perkuliahan
     * @return \Illuminate\Http\Response
     */
    public function show(Perkuliahan $perkuliahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perkuliahan  $perkuliahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perkuliahan $perkuliahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perkuliahan  $perkuliahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perkuliahan $perkuliahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perkuliahan  $perkuliahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perkuliahan $perkuliahan)
    {
        //
    }
}
