<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode'
    ];

    public function perkuliahan() {
        return $this->hasMany(Perkuliahan::class);
    }
}