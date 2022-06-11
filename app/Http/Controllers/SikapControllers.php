<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Sikap;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SikapControllers extends Controller
{
    public function index(){
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $kelas = Wali::where('guru_id',$guru->id)->get();
        return view('guru.sikap.index',compact('guru','kelas')); 
    }

    public function tambah(Request $request,$id){
        $kelas = Kelas::findorfail($id);
        $siswa = Siswa::where('kelas_id',$kelas->id)->where('status','aktif')->get();
        $tahun = Tahun::orderBy('id','DESC')->first();
        return view('guru.sikap.tambah',compact('tahun','siswa','kelas'));
    }

    public function simpan(Request $request){
        foreach ($request->siswa_id as $key => $value) {
           $sikap = new Sikap();
           $sikap->spiritual = $request->sp[$key];
           $sikap->sosial = $request->so[$key];
           $sikap->kelas_id = $request->kelas;
           $sikap->tahun_id = $request->tahun;
           $sikap->siswa_id = $value;
           $sikap->save();
        }
        return redirect()->back()->with('success', 'Berhasil menambah data sikap!');

    }

    public function edit($id){
        $kelas = Kelas::findorfail($id);
        $tahun = Tahun::orderBy('id','DESC')->first();
        $sikap = Sikap::where('kelas_id',$kelas->id)->where('tahun_id',$tahun->id)->get();
        return view('guru.sikap.edit',compact('tahun','sikap','kelas'));
    }

    public function update(Request $request){
        foreach ($request->siswa_id as $key => $value) {
            $sikap = Sikap::findorfail($request->sikap_id[$key]);
            $sikap->spiritual = $request->sp[$key];
            $sikap->sosial = $request->so[$key];
            $sikap->kelas_id = $request->kelas;
            $sikap->tahun_id = $request->tahun;
            $sikap->siswa_id =$value;
            $sikap->update();
        }
        return redirect()->back()->with('success', 'Berhasil update data sikap!');
    }
}
