<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswas";
    protected $fillable = ['nisn','nis','nama', 'tmp','tgl','jk','agama','alamat','ayah','ibu','tlp','status','kelas_id'];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function absensi(){
        return $this->hasMany(Absen::class);
    }


    public function ulangan()
    {
        return $this->hasMany(Ulangan::class);
    }

    public function nilai(){
        return $this->hasMany(Nilai::class);
    }

    public function tugas(){
        return $this->hasMany(Tugas::class);
    }

    public function rapot(){
        return $this->hasMany(Raport::class);
    }

    public function keterampilan(){
        return $this->hasMany(Keterampilan::class);
    }

}
