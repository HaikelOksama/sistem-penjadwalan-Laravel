<?php

namespace App\Http\Livewire\Matakuliah;

use App\Models\Matakuliah;
use Livewire\Component;

class MatakuliahEdit extends Component
{
    public $matakuliahClass;

    public $matkulId;
    public $nama;
    public $kode;
    public $sks;

    // protected $listeners = [
    //     'getMatakuliah' => 'handleMatakuliah'
    // ];

    public function mount($matakuliah) {
        $this->matakuliahClass = $matakuliah;
        $this->nama = $matakuliah->nama;
        $this->kode = $matakuliah->kode;
        $this->sks = $matakuliah->sks;
    }

    public function render()
    {
        return view('livewire.matakuliah.matakuliah-edit');
    }

    public function handleMatakuliah(Matakuliah $matakuliah){
        $this->matkulId = $matakuliah->id;
        $this->nama = $matakuliah->nama;
        $this->kode = $matakuliah->kode;
        $this->sks = 2;
    }

    public function update() {
        $input = $this->validate([
            'nama' => 'required|min:3',
            'kode' => 'required|min:3',
            'sks' => 'required|min:1|integer|max_digits:1'
        ]);
        
        $instance = $this->matakuliahClass;
        $instance->update($input);
        
        $this->emit('updated', $instance->nama);
    }

    public function clearInput() {
        $this->nama = null;
        $this->kode = null;
        $this->sks = null;
    }
}      
