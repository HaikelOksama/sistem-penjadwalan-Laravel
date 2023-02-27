<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip'
    ];

    public function matakuliah() {
        return $this->belongsToMany(Matakuliah::class);
    }

    public function addMatakuliah($matakuliah) {
        $this->matakuliah()->attach($matakuliah);
    }

    public function perkuliahan() {
        return $this->belongsToMany(Perkuliahan::class);
    }

    public function scopeFilterSearch($query, $search) {
        return $query->where('nama', 'like' , '%'.$search.'%');
    }

}
