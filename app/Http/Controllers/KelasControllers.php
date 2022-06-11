<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KelasControllers extends Controller
{
    public function index(){
        $wali = Wali::all();
        $guru = Guru::all();
        return view('admin.kelas.index',compact('wali','guru'));
    }

    public function simpan(Request $request){

        $validate = Validator::make($request->all(),[
            'kelas' => 'unique:kelases,kelas',
            'guru' => 'unique:walis,guru_id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Kelas atau guru yang di input sudah ada!');
        }else{
                
            foreach ($request->kelas as $key => $value) {
                $kelas = new Kelas();
                $wali = new Wali();

                $kelas->kelas = $value;
                $kelas->save();
                if ($request->guru[$key] == Null) {
                    $wali->kelas_id = $kelas->id;
                    $wali->guru_id = Null;
                    $wali->save();
                } else {
                    $wali->kelas_id = $kelas->id;
                    $wali->guru_id = $request->guru[$key];
                    $wali->save();
                    $guru = Guru::findorfail($wali->guru_id);
                    $user = User::findorfail($guru->user_id);
                    $user->role = 'wali kelas';
                    $user->update();
                }
            }
            return redirect()->back()->with('success', 'Berhasil menambahkan data kelas!');
        }
    }

    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'guru' => 'unique:walis,guru_id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Guru yang di input sudah ada!');
        }else{
            $wali = Wali::findorfail($id);
            $wali->guru_id = $request->guru;
            $wali->update();
            return redirect()->back()->with('success', 'Berhasil mengupdate data kelas!');
        }
    }

    public function wali(){
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $wali = Wali::where('guru_id',$guru->id)->first();
        $siswa = Siswa::where('kelas_id',$wali->id)->where('status','aktif')->get();

        return view('guru.kelas.index',compact('siswa','wali'));
    }

    public function list(){
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $kelas = Wali::where('guru_id',$guru->id)->first();
        $siswa = Siswa::where('kelas_id',$kelas->id)->get();

        return view('guru.kelas.index',compact('siswa', 'kelas'));
    }

    public function detail($id){
        $siswa = Siswa::where('id',$id)->get();

        return view('guru.kelas.siswa',compact('siswa'));
    }

}
