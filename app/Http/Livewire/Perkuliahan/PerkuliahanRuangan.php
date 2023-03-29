<?php

namespace App\Http\Livewire\Perkuliahan;

use App\Models\Perkuliahan;
use App\Models\RuangKelas;
use Livewire\Component;

class PerkuliahanRuangan extends Component
{


    public function render()
    {
        $timeSlots = [
            '07:30-08:20' => ['available'=>true],
            '08:20-09:10' => ['available'=>true],
            '09:10-10:00' => ['available'=>true],
            '10:00-10:50' => ['available'=>true],
            '10:50-11:40' => ['available'=>true],
            '11:40-12:30' => ['available'=>true],
            '12:30-13:00' => ['available'=>true],
            '13:00-13:50' => ['available'=>true],
            '13:50-14:40' => ['available'=>true],
            '14:40-15:30' => ['available'=>true],
            '15:30-16:20' => ['available'=>true],
            '16:20-17:10' => ['available'=>true],
            '17:10-18:00' => ['available'=>true],
        ];

        $perkuliahan = Perkuliahan::all();
        $ruangan = RuangKelas::orderBy('lokasi', 'asc')
                    ->orderBy('kode', 'asc')->get();
        
        $availability = [];
        foreach($ruangan as $item) {
            $availability[$item->id] = [
                1 => $timeSlots,
                2 => $timeSlots,
                3 => $timeSlots,
                4 => $timeSlots,
                5 => $timeSlots,
                6 => $timeSlots,
            ];
        }

        foreach($perkuliahan as $data) {
            $start = substr($data->waktu, 0, 5);
            $end = substr($data->berakhir, 0, 5);

            $kodeRuangan = $data->id_kelas;
            $hari = $data->hari;

            foreach($timeSlots as $slot => $val) {
                if(substr($slot, 0 ,5) >= $start  && substr($slot,6) <= $end ) {
                    $availability[$kodeRuangan][$hari][$slot]['available'] = false;
                }
            }
        }

        dd($availability);

        return view('livewire.perkuliahan.perkuliahan-ruangan');
    }
}
