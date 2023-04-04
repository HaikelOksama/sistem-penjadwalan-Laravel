<?php

namespace App\Http\Livewire\Ruangkelas;

use App\Models\RuangKelas;
use Livewire\Component;
use Livewire\WithPagination;

class RuangkelasIndex extends Component
{
    use WithPagination;
    public $paginateNumber = 10;
    public $listKelas;
    public $search;

    protected $listeners = [
        'stored' => 'handleStored',
        'updated' => 'handleUpdated',
        'deleteInstance' => 'handleDelete'
    ];

    public function render()
    {
        $this->listKelas = RuangKelas::all();
        $ruangkelas = RuangKelas::orderBy('lokasi', 'desc')->orderBy('kode', 'asc')
        ->when($this->search, fn($query) => $query->filterSearch($this->search))
        ->paginate($this->paginateNumber);
        return view('livewire.ruangkelas.ruangkelas-index', ['ruangkelas' => $ruangkelas]);
    }

    public function handleDelete($instance){
        $instance = RuangKelas::find($instance)->first();
        $instance->delete();

        $this->emit('deleted', 'Ruangan '.$instance->kode);
    }

    public function handleStored($instance){
        session()->flash('message', $instance);
    }

    public function handleUpdated($instance) {
        session()->flash('message', $instance);
    }
}
