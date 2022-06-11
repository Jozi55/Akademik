<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;
    protected $table = "tahuns";
    protected $fillable = ['tahun', 'semester'];

    public function sikap(){
        return $this->hasMany(Sikap::class);
    }

    public function absensi(){
        return $this->hasMany(Absen::class);
    }

    public function nilai(){
        return $this->hasMany(Nilai::class);
    }

    public function kkm(){
        return $this->hasMany(KKM::class);
    }

    public function tugas(){
        return $this->hasMany(Tugas::class);
    }

    public function ulangan(){
        return $this->hasMany(Ulangan::class);
    }

    public function rapot(){
        return $this->hasMany(Raport::class);
    }

    public function predikat(){
        return $this->hasMany(Predikat::class);
    }

    public function keterampilan(){
        return $this->hasMany(Keterampilan::class);
    }

    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }

}
