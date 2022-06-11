<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KKM extends Model
{
    use HasFactory;
    protected $table = "kkms";
    protected $fillable = ['kkm','tahun_id' , 'kelas_id' , 'mapel_kode'];

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
        return $this->hasMany(Raport::class);
    }
}
