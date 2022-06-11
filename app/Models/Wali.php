<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;
    protected $table = "walis";
    protected $fillable = ['guru_id','kelas_id'];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function guru(){
        return $this->belongsTo(Guru::class);
    }

}
