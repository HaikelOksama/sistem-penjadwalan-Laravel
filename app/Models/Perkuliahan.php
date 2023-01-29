<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkuliahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'waktu',
        'semester',
        'tahun'
    ];

    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }

    public function ruangan() {
        return $this->belongsTo(RuangKelas::class);
    }
}
