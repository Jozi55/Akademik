<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pembagian;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiControllers extends Controller
{
    public function index(){
        $tahun = Tahun::orderBy('id','DESC')->first();
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $mapel1 = Mapel::where('nama','matematika')->first();
        $mapel2 = Mapel::where('nama','penjas teori')->first();
        $pembagian = Pembagian::where('guru_id',$guru->id)->whereNotIn('mapel_kode',[$mapel1->kode])->whereNotIn('mapel_kode',[$mapel2->kode])->where('tahun_id',$tahun->id)->get();
        return view('guru.nilai.index',compact('pembagian'));
    }
        

    public function guruNilai($id){
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $pembagian = Pembagian::findorfail($id);
        $tahun = Tahun::orderBy('id','DESC')->first();
        $nilai = Nilai::where('kelas_id',$pembagian->kelas_id)->where('mapel_kode',$pembagian->mapel_kode)->where('tahun_id',$tahun->id)->get();
        return view('guru.nilai.view',compact('nilai'));
        
    }

}
