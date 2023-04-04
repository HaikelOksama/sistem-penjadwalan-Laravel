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

    public function lokasi(){
        if($this->lokasi == 'kampus_utama') {
            return 'Kampus Utama';
        }
        return 'Kampus Sukajadi';
    }

    public function scopeFilterSearch($query, $search) {
        return $query->where('kode', 'like', '%'.$search.'%')
        ->orWhere('lokasi', 'like', '%'.$search.'%');
    }

    public function kampusUtama() {
        $ruangan = $this->where('lokasi', '=', 'kampus_utama')->get();
        return $ruangan;
    }

    public function perkuliahan() {
        return $this->hasMany(Perkuliahan::class);
    }
}
