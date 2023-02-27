<?php

namespace App\Http\Livewire;

use App\Models\Dosen;
use App\Models\Matakuliah;
use Livewire\Component;

class DosenMatakuliah extends Component
{
    public Dosen $dosen;
    public $matakuliahList;
    public $matakuliahSelected = [];


    protected $listeners = [
        'getMatakuliah' => 'handleMatakuliah'
    ];

    public function mount($dosen){
        $this->matakuliahList = Matakuliah::all();
        $this->dosen = $dosen;
        $this->matakuliahSelected = $this->dosen->matakuliah->pluck('id')->toArray();
    }

    public function render()
    {
        return view('livewire.dosen-matakuliah');
    }

    public function handleMatakuliah(Dosen $dosen){
        $this->matakuliahSelected = [];
        // $this->idDosen = $dosen->id;
        // $matakuliah = $dosen->matakuliah;
        // foreach($matakuliah as $matkul){
        //     array_push($this->matakuliahSelected, $matkul);
        // }
        // $this->matakuliahSelected = $matakuliah;
    }
}
