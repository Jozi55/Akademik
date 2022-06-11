<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulangan extends Model
{
    use HasFactory;
    protected $table = "ulangans";
    protected $fillable = ['keterangan','ke','nilai','tahun_id','kelas_id','siswa_id','mapel_kode'];

    public function tahun(){
        return $this->belongsTo(Tahun::class);
    }

    public function mapel(){
        return $this->belongsTo(Mapel::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
}
