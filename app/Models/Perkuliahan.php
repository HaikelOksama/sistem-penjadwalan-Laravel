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
        'kelas'
    ];

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

    public function getFuck($dosenMatakuliah){
        $matkul = DosenMatakuliah::find($dosenMatakuliah);
        return $this->join('dosens', 'dosens.nip', '=', 'dosens.nip')
                ->join('matakuliah', 'matakuliah.kode', '=', 'matakuliah.kode')
                ->select('matakuliah.nama as nama_matkul', 'dosens.nama as nama_dosen', 'perkuliahans.*')
                ->where('dosens.nip' , '=' , $matkul->dosen->nip)
                ->where('matakuliah.kode' , '=' , $matkul->matakuliah->kode);
    }

    public function ruangan() {
        return $this->belongsTo(RuangKelas::class);
    }
}
