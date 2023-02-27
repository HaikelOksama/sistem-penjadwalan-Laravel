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
        'nama'
    ];

    public function dosen(){
        return $this->belongsToMany(Dosen::class);
    }

    public function perkuliahan() {
        return $this->belongsToMany(Perkuliahan::class);
    }
}
