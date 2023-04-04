<?php

namespace App\Http\Livewire\Ruangkelas;

use App\Models\RuangKelas;
use Livewire\Component;

class RuangkelasCreate extends Component
{

    public $kode;
    public $lokasi = 'kampus_utama';

    public $dismissState = true;

    public function render()
    {
        return view('livewire.ruangkelas.ruangkelas-create');
    }

    public function store(){
        $input = $this->validate([
            'kode' => 'required|min:3',
            'lokasi' => 'required'
        ]);

        $instance = RuangKelas::create($input);
        $this->emit('stored', [
            'instance'=>'Ruangan '.$instance->kode, 
            'dismiss'=> $this->dismissState
        ]);
    }

    public function clearInput(){
        $this->kode = null;
    }
}
