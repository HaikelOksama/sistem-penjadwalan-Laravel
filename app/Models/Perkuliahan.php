<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkuliahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kelas',
        'id_dosen_matakuliah',
        'hari',
        'waktu',
        'berakhir',
        'tahun',
        'semester',
        'kelas',
        'ajaran'
    ];

    public function getDayName() {
        $days = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu'
        ];

        $model = $this->hari;

        foreach ($days as $day => $value) {
            if($day == $model) {
                return $value;
            }
        }
    }

    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }

    public function scopeFilterByTahun($query, $tahun) {
        return $query->where('tahun', '=', $tahun);
    }

    public function scopeFilterByKelas($query,$tahun,$semester, $kelas) {
        return $query->where('tahun' , '=', $tahun)
                    ->where('kelas' , '=', $kelas)
                    ->where('semester' , '=', $semester);
    }

    public function getDosenMatakuliah($dosenMatakuliah) {
        $matkul = DosenMatakuliah::find($dosenMatakuliah);
        return $matkul;
    }

    public function getRuangan($ruangan) {
        $ruangan = RuangKelas::find($ruangan);
        return $ruangan;
    }

    public function ruangan() {
        return $this->belongsTo(RuangKelas::class);
    }

    public static function availability($tahun, $ajaran) {
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

        $perkuliahan = Perkuliahan::orderBy('id_kelas', 'asc')
                        ->orderBy('kelas', 'asc')
                        ->where('tahun', $tahun)
                        ->where('ajaran', $ajaran)->get();
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
            $dosenMatakuliah = $data->getDosenMatakuliah($data->id_dosen_matakuliah);
            $dosen = Dosen::find($dosenMatakuliah->dosen_id)->nama;
            $matakuliah = Matakuliah::find($dosenMatakuliah->matakuliah_id);
            foreach($timeSlots as $slot => $val) {
                if(substr($slot, 0 ,5) >= $start  && substr($slot,6) <= $end ) {
                    $availability[$kodeRuangan][$hari][$slot]['available'] = false;
                    $availability[$kodeRuangan][$hari][$slot]['dosen'] = $dosen;
                    $availability[$kodeRuangan][$hari][$slot]['matakuliah'] = $matakuliah;
                    $availability[$kodeRuangan][$hari][$slot]['semester'] = $data->semester;
                }
            }
        }

        return $availability;
    }
}
