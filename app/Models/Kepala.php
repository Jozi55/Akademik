<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepala extends Model
{
    use HasFactory;
    protected $table = "kepalas";
    protected $fillable = ['nip', 'name','status'];
}
