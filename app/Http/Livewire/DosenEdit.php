<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Request;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Livewire\Component;

class DosenEdit extends Component
{
    public $matakuliahList;
    
    public $dosen;
    public $nama;
    public $nip;
    public $matakuliahSelected = [];
    public $matakuliahInput = [];

    public bool $loadState = false;

    public function init() {
        $this->loadState = true;
    }

    protected $listeners = [
        'getDosen' => 'showDosen',
        'select2Changed' => 'handleSelectChanged',
    ];

    public function mount(){
        $this->matakuliahList = Matakuliah::orderBy('nama', 'asc')->get();
    }

    public function render()
    {
       
        return view('livewire.dosen-edit');
    }

    public function showDosen(Dosen $dosen){
        // dd($dosen->matakuliah);
        $this->dosen = $dosen;
        $this->nama = $dosen->nama;
        $this->nip = $dosen->nip;
        $this->matakuliahSelected = $dosen->matakuliah->pluck('id')->toArray();
        $this->emit('getMatakuliah', $this->matakuliahSelected);
        // $this->matakuliahInput = $dosen->matakuliah->pluck('id')->toArray();
    }

    public function handleSelectChanged($val) {
        $this->matakuliahInput = $val;
    }

    public function updateDosen(){
        $this->matakuliahSelected = $this->matakuliahInput;

        $input = $this->validate([
            'nama' => 'required',
            'nip' => 'required|numeric',
            'matakuliahSelected' => 'required|array',
            'matakuliahInput' => 'required|array'
        ]);
        $instance = Dosen::find($this->dosen->id);

        $instance->update($input);
        $instance->matakuliah()->sync($input['matakuliahSelected']);
        $this->emit('updated', $instance->nama);
    }

    public function resetData(){
        $this->dosen = null;
        $this->nama = null;
        $this->nip = null;
        $this->matakuliahSelected = [];
        $this->matakuliahInput = [];
        $this->emit('resetData');
    }
}
