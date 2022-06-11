<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembagian extends Model
{
    use HasFactory;
    protected $table = "pembagians";
    protected $fillable = ['guru_id','kelas_id','mapel_kode'];

    public function mapel(){
        return $this->belongsTo(Mapel::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function guru(){
        return $this->belongsTo(Guru::class);
    }
}
