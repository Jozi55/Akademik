<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = "kelases";
    protected $fillable = ['kelas'];

    public function wali(){
        return $this->hasOne(Wali::class);
    }

    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }

    public function siswa(){
        return $this->hasMany(Siswa::class);
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

    public function rapot(){
        return $this->hasMany(Raport::class);
    }

    public function predikat(){
        return $this->hasMany(Predikat::class);
    }
    public function pembagian(){
        return $this->hasMany(Pembagian::class);
    }

    public function sikap(){
        return $this->hasMany(Sikap::class);
    }


}


