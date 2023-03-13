<?php

namespace App\Http\Livewire\Dosen;

use App\Models\Dosen;
use App\Models\Matakuliah;
use Livewire\Component;

class DosenCreate extends Component
{
    public $nama;
    public $nip;
    public $matakuliahInput = [];
    public $matakuliahList = [];
    public $dismissState;

    protected $listeners = [
        'select2Changed' => 'handleSelectChanged',
    ];

    public function mount() {
        $this->matakuliahList = Matakuliah::orderBy('nama', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.dosen.dosen-create');
    }

    public function handleSelectChanged($val) {
        $this->matakuliahInput = $val;
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

    public function clearInput() {
        $this->nama = null;
        $this->nip = null;
        $this->matakuliahInput = [];
        $this->emit('resetData');
    }
}
