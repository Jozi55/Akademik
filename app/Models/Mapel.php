<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = "mapels";
    protected $fillable = ['kode','nama','mapel', 'kelompok'];
    protected $primaryKey = 'kode';
    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
    
    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }

    public function ulangan()
    {
        return $this->hasMany(Ulangan::class);
    }

    public function pembagian()
    {
        return $this->hasMany(Pembagian::class);
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


    public function predikat(){
        return $this->hasMany(Predikat::class);
    }

    public function rapot()
    {
        return $this->hasMany(Raport::class);
    }

}
