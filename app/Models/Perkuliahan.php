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
}
