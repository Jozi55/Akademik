<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use HasFactory;
    protected $table = "raports";
    protected $fillable = ['nilai_p','predikat_p','deskripsi_p', 'nilai_k','predikat_k','deskripsi_k','tahun_id' , 'kelas_id' , 'mapel_kode','kkm_id','siswa_id'];

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

    public function kkm(){
        return $this->belongsTo(KKM::class);
    }
}
