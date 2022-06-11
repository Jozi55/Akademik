<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = "nilais";
    protected $fillable = ['t_uh','t_tugas', 't_pts','t_pas','n_akhir','t_nilai' ,'tahun_id' , 'kelas_id' , 'mapel_kode','siswa_id'];

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
