<?php

namespace App\Http\Livewire\Perkuliahan;

use App\Models\Perkuliahan;
use App\Models\RuangKelas;
use Carbon\Carbon;
use Livewire\Component;

class PerkuliahanRuangan extends Component
{
    public $ajaran;
    public $tahun;

    public $dataRuangan;

    public $dataHari = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu'
    ];

    public $timeSlots = [
        '07:30-08:20',
        '08:20-09:10',
        '09:10-10:00',
        '10:00-10:50',
        '10:50-11:40',
        '11:40-12:30',
        '12:30-13:00',
        '13:00-13:50',
        '13:50-14:40',
        '14:40-15:30',
        '15:30-16:20',
        '16:20-17:10',
        '17:10-18:00',
    ];

    public function mount(){
        $currMonth = Carbon::now()->month;
        $currYear = Carbon::now()->year;
        $this->tahun = $currYear;
        if ($currMonth >= 6 || $currMonth < 2) {
            $this->ajaran = 'ganjil';
        } else {
            $this->ajaran = 'genap';
        }

        
    }

    public function render()
    {
        $availability = Perkuliahan::availability($this->tahun, $this->ajaran);
   
        $this->dataRuangan = $this->getRuangan();
        return view('livewire.perkuliahan.perkuliahan-ruangan', ['availability' => $availability]);
    }

    public function getRuangan(){
        $data = Perkuliahan::availability($this->tahun, $this->ajaran);
        // dd($data);
        $dataRuangan = [];
        foreach($data as $ruangan => $key){
            $rn = RuangKelas::find($ruangan);
            array_push($dataRuangan, $rn);
        }
        return $dataRuangan;
    }

    public function getNamaRuangan($ruangan) {
        $find = RuangKelas::find($ruangan);
        if($find->lokasi == 'kampus_sukajadi'){
            return 'SKJD '.$find->kode;
        }
        return $find->kode;
    }


}
