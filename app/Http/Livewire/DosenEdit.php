<?php

namespace App\Http\Livewire;

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
    // public $matakuliahInput = [];

    protected $listeners = [
        'getDosen' => 'showDosen',
    ];


    public function render()
    {
        $this->matakuliahList = Matakuliah::orderBy('nama', 'asc')->get();
        
        $this->emit('getMatakuliah', $this->dosen);
        return view('livewire.dosen-edit');
    }

    public function showDosen(Dosen $dosen){
        // dd($dosen->matakuliah);
        $this->dosen = $dosen;
        $this->nama = $dosen->nama;
        $this->nip = $dosen->nip;
        $this->matakuliahSelected = $dosen->matakuliah->pluck('id')->toArray();
    }

    public function updateDosen(){
        $input = $this->validate([
            'nama' => 'required',
            'nip' => 'required|numeric',
            'matakuliahSelected' => 'required|array',
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

    }
}
