<?php

namespace App\Http\Livewire\Matakuliah;

use App\Models\Matakuliah;
use Livewire\Component;

class MatakuliahCreate extends Component
{
    public $nama;
    public $kode;
    public $sks;

    public $dismissState = true;

    public function render()
    {
        return view('livewire.matakuliah.matakuliah-create');
    }

    public function store() {
        $input = $this->validate([
            'nama' => 'required|min:3',
            'kode' => 'required|min:2',
            'sks' => 'required'
        ]);

        

        $matakuliah = Matakuliah::create($input);
        $this->clearInput();
        $this->emit('stored', ['instance' => $matakuliah->nama , 'dismiss' => $this->dismissState]);
    }

    public function clearInput() {
        $this->nama = null;
        $this->kode = null;
        $this->sks = null;
    }
}
