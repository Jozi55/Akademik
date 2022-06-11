<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = "gurus";
    protected $fillable = ['nip','nama','status','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function wali(){
        return $this->hasOne(Wali::class);
    }

    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }

    public function pembagian(){
        return $this->hasMany(Pembagian::class);
    }
}
