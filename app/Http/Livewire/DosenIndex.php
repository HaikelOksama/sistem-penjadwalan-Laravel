<?php

namespace App\Http\Livewire;

use App\Models\Dosen;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class DosenIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginateNumber = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $search;
    public $count;

    protected $listeners = [
        'stored' => 'handleDosenStored',
        'deleteDosen' => 'handleDosenDelete',
        'updated' => 'handleDosenUpdated'
    ];

    public function render()
    {
        $dosen = Dosen::latest()->
            when($this->search, fn($query) => $query->FilterSearch($this->search))->paginate($this->paginateNumber);
        $this->count = count($dosen);
        return view('livewire.dosen-index', ['dosen' => $dosen]);
    }

    public function handleDosenStored($dosen){
        session()->flash('created', $dosen);
    }

    public function handleDosenUpdated($instance){
        Session::flash('updated', 'Berhasil Di Update');
    }

    public function getDosen($id) {
        $dosen = Dosen::find($id);
        $this->emit('getDosen', $dosen);
    }

    public function handleDosenDelete($item) {
        $dosen = Dosen::findOrFail($item['id']);
        $dosen->delete();
    }
}
