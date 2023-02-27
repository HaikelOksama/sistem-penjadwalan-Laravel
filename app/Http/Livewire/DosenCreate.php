<?php

namespace App\Http\Livewire;

use App\Models\Dosen;
use App\Models\Matakuliah;
use Livewire\Component;

class DosenCreate extends Component
{
    public $nama;
    public $nip;
    public $matakuliahInput = [];

    public function render()
    {
        $matakuliah = Matakuliah::orderBy('nama', 'asc')->get();
        return view('livewire.dosen-create', ['matakuliah' => $matakuliah]);
    }

    public function store(){
        $input = $this->validate([
            'nama' => 'required',
            'nip' => 'required|numeric',
            'matakuliahInput' => 'required|array',
        ]);
        // dd($input['matakuliahInput']);
        
        $dosen = Dosen::create($input);
        $dosen->addMatakuliah($input['matakuliahInput']);

        $this->clearInput();
        $this->emit('dosenStored', $dosen);
    }

    private function clearInput() {
        $this->nama = null;
        $this->nip = null;
        $this->matakuliahInput = [];
    }
}
