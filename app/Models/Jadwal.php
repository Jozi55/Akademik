<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = "jadwals";
    protected $fillable = ['hari','jam','guru_id','kelas_id','mapel_kode','tahun_id'];

    public function mapel(){
        return $this->belongsTo(Mapel::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function guru(){
        return $this->belongsTo(Guru::class);
    }

    public function tahun(){
        return $this->belongsTo(Tahun::class);
    }

    public function rapot($mapel_kode)
  {
    $mapel = Mapel::where('kode', $mapel_kode)->first();
    return $mapel;
  }
}
