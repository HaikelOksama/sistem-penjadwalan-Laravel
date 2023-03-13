<?php

namespace App\Http\Livewire\Matakuliah;

use App\Models\Matakuliah;
use Livewire\Component;
use Livewire\WithPagination;

class MatakuliahIndex extends Component
{

    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    // public $paginateNumber = 10;

    public $matakuliah;
    public $search;

    protected $listeners = [
        'stored' => 'handleMatakuliahStored',
        'deleteInstance' => 'handleMatakuliahDelete',
        'updated' => 'handleMatakuliahUpdated'
    ];

    public function render()
    {
        $this->matakuliah = Matakuliah::orderBy('nama', 'asc')->get();
        if(isset($this->search)){
            $this->matakuliah = Matakuliah::when($this->search, fn ($query) => $query->filterSearch($this->search))->get();
        }

        return view('livewire.matakuliah.matakuliah-index');
    }

    public function handleMatakuliahStored($instance){
        session()->flash('created', $instance);
    }

    public function handleMatakuliahDelete($instance) {
        $matakuliah = Matakuliah::find($instance)->first();
        $instance = $matakuliah->nama;
        
        $matakuliah->delete();
        $this->emit('deleted', $instance);
    }

    public function handleMatakuliahUpdated($instance){
        session()->flash('updated', $instance);
    }

    public function getMatakuliah($matakuliah){
        $instance = Matakuliah::find($matakuliah);
        $this->emit('getMatakuliah', $instance);
    }
}
