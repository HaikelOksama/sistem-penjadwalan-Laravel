<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenMatakuliah extends Model
{
    use HasFactory;
    
    public $table = 'dosen_matakuliah';

    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }

    public function matakuliah() {
        return $this->belongsTo(Matakuliah::class);
    }

    public function perkuliahan() {
        return $this->belongsTo(Perkuliahan::class);
    }

    public function getDosenMatakuliah($dosen, $matakuliah) {
        $getDosen = Dosen::where('id', $dosen)->first();
        $getMatakuliah = Matakuliah::where('id', $matakuliah)->first();
        
        return [
            "dosen" => $getDosen,
            "matakuliah" => $getMatakuliah
        ];
    }
}
