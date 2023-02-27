<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index() {
        $dosen = Dosen::all();
        return view('dosen.index' , ['dosen' => $dosen]);
    }

    public function create() {
        $mataKuliah = Matakuliah::all();
        return view('dosen.create', ['matakuliah' => $mataKuliah]);
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:dosens',
        ]);

        $dosen = Dosen::create($formFields);

        $selectedMatkul = $request->input('matkul');
        $dosen->addMatakuliah($selectedMatkul);

        return redirect()->route('dosen.index')->with('success', $formFields['nama'] . ' Telah ditambahkan.');
    }
}
