<?php

namespace App\Http\Livewire\Dosen;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Builder;
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
    public bool $sortQuery = true;

    protected $listeners = [
        'stored' => 'handleDosenStored',
        'deleteInstance' => 'handleDosenDelete',
        'updated' => 'handleDosenUpdated'
    ];

    //TODO: SORTING NEXT MAYBE???

    public function sortName() {
        $this->sortQuery = !$this->sortQuery;
    }

    public function render()
    {
        $dosen = Dosen::
            when($this->sortQuery, function (Builder $query) {
                $query->orderBy('nama', 'asc');
            }, function (Builder $query) {
                $query->orderBy('nama', 'desc');
            })
            ->when($this->search, fn($query) => $query->FilterSearch($this->search))->paginate($this->paginateNumber);
        $this->count = count($dosen);
        return view('livewire.dosen.dosen-index', ['dosen' => $dosen]);
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
        $instance = $dosen->nama;
        $dosen->delete();
        $this->emit('deleted', $instance);
    }
}
