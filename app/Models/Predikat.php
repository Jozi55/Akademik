<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predikat extends Model
{
    use HasFactory;
    protected $table = "predikats";
    protected $fillable = ['a','b', 'c','d','dpa','dpb','dpc','dpd','dka','dkb','dkc','dkd' ,'tahun_id' , 'kelas_id' , 'mapel_kode','siswa_id'];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function tahun(){
        return $this->belongsTo(Tahun::class);
    }

    public function mapel(){
        return $this->belongsTo(Mapel::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}
