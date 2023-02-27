<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'lokasi'
    ];

    public function kampusUtama() {
        $ruangan = $this->where('lokasi', '=', 'kampus_utama')->get();
        return $ruangan;
    }

    public function perkuliahan() {
        return $this->hasMany(Perkuliahan::class);
    }
}
