<?php

namespace App\Http\Livewire;

use App\Models\Dosen;
use Livewire\Component;

class DosenIndex extends Component
{
    public $search;
    public $count;

    protected $listeners = [
        'dosenStored' => 'handleDosenStored',
    ];

    public function render()
    {
        $dosen = Dosen::latest()->
            when($this->search, fn($query) => $query->FilterSearch($this->search))->get();
        $this->count = count($dosen);
        return view('livewire.dosen-index', ['dosen' => $dosen]);
    }

    public function handleDosenStored(){
        session()->flash('success', 'Dosen berhasil Ditambahkan');
    }

    public function getDosen($id) {
        $dosen = Dosen::find($id);
        $this->emit('getDosen', $dosen);
    }

}
