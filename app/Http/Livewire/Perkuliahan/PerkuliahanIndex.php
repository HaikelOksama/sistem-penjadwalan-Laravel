<?php

namespace App\Http\Livewire\Perkuliahan;

use App\Models\Perkuliahan;
use Carbon\Carbon;
use Livewire\Component;

class PerkuliahanIndex extends Component
{

    public function render()
    {
        $day = Carbon::getDays();
        // dd($day);

        $perkuliahan = Perkuliahan::orderBy('tahun', 'desc')
                        ->orderBy('semester','asc')->orderBy('kelas', 'asc')->get();
        return view('livewire.perkuliahan.perkuliahan-index', ['perkuliahan' => $perkuliahan]);
    }
}
