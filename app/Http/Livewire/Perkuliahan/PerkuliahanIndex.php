<?php

namespace App\Http\Livewire\Perkuliahan;

use App\Models\Perkuliahan;
use Carbon\Carbon;
use Livewire\Component;

class PerkuliahanIndex extends Component
{
    protected $listeners = [
        'deleteInstance' => 'onDeleted'
    ];

    public function render()
    {
        $day = Carbon::getDays();
        // dd($day);

        $perkuliahan = Perkuliahan::orderBy('tahun', 'desc')
                        ->orderBy('semester','asc')->orderBy('kelas', 'asc')->get();
        return view('livewire.perkuliahan.perkuliahan-index', ['perkuliahan' => $perkuliahan]);
    }

    public function onDeleted($instance){
        $instance = Perkuliahan::find($instance['id']);
        $instance->delete();
        $this->emit('deleted', 'Data Perkuliahan');
    }
}
