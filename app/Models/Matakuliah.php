<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    public $table = 'matakuliah';

    protected $fillable = [
        'kode',
        'nama',
        'sks'
    ];

    public function scopeFilterSearch($query, $search) {
        return $query->where('nama', 'like' , '%'.$search.'%');
    }

    public function dosen(){
        return $this->belongsToMany(Dosen::class);
    }

    public function perkuliahan() {
        return $this->belongsToMany(Perkuliahan::class);
    }
}
