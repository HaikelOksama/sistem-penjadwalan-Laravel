<?php

namespace App\Http\Livewire\Ruangkelas;

use App\Models\RuangKelas;
use Livewire\Component;

class RuangkelasEdit extends Component
{
    public $ruangkelas;
    public $kode;
    public $lokasi;

    public function mount($ruangkelas) {
        $this->ruangkelas = $ruangkelas;
        $this->kode = $ruangkelas->kode;
        $this->lokasi = $ruangkelas->lokasi;
    }

    public function render()
    {
        return view('livewire.ruangkelas.ruangkelas-edit');
    }

    public function update() {
        $input = $this->validate([
            'kode' => 'required|min:3',
            'lokasi' => 'required'
        ]);

        $instance = $this->ruangkelas;
        $instance->update($input);

        $this->emit('updated', 'Ruangan '.$instance->kode);
    }
}
