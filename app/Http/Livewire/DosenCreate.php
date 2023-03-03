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
    public $dismissState;

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
        $this->emit('stored', ['instance' => $dosen->nama , 'dismiss' => $this->dismissState]);
    }

    private function clearInput() {
        $this->nama = null;
        $this->nip = null;
        $this->matakuliahInput = [];
    }
}
