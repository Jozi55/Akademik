<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KKM;
use App\Models\Mapel;
use App\Models\Pembagian;
use App\Models\Predikat;
use App\Models\Tahun;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KkmControllers extends Controller
{
    public function index(){
        $tahun = Tahun::orderBy('id','DESC')->first();
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $mapel1 = Mapel::where('nama','matematika')->first();
        $mapel2 = Mapel::where('nama','penjas teori')->first();
        $pembagian = Pembagian::where('guru_id',$guru->id)->whereNotIn('mapel_kode',[$mapel1->kode])->whereNotIn('mapel_kode',[$mapel2->kode])->where('tahun_id',$tahun->id)->orderBy('kelas_id','ASC')->get();
        return view('guru.kkm.index',compact('pembagian'));
    }

    public function tambah(Request $request, $id){
        $pembagian = Pembagian::findorfail($id);
        $tahun = Tahun::orderBy('id','DESC')->first();
        $kkm = KKM::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->first();
        if ($kkm == NULL) {
            return view('guru.kkm.tambah',compact('pembagian','tahun'));
        } else {
            return redirect()->back()->with('error', 'KKM Untuk Semester Sekarang Sudah Diinput!');
        }
    }

    public function simpan(Request $request){

        $kkm = new KKM();
        $kkm->kelas_id = $request->kelas;
        $kkm->mapel_kode = $request->mapels;
        $kkm->tahun_id = $request->tahun;
        $kkm->kkm = $request->kkm;
        $kkm->save();

        $predikat = new Predikat();
        $predikat->kelas_id = $request->kelas;
        $predikat->mapel_kode = $request->mapels;
        $predikat->tahun_id = $request->tahun;
        $predikat->a = $request->a;
        $predikat->b = $request->b;
        $predikat->c = $request->c;
        $predikat->d = $request->d;
        $predikat->dpa = $request->dpa;
        $predikat->dpb = $request->dpb;
        $predikat->dpc = $request->dpc;
        $predikat->dpd = $request->dpd;
        $predikat->dka = $request->dka;
        $predikat->dkb = $request->dkb;
        $predikat->dkc = $request->dkc;
        $predikat->dkd = $request->dkd;
        $predikat->save();

        return redirect()->route('kkm')->with('success', 'Berhasil menambah data nilai kkm!');
    }

    public function edit(Request $request ,$id){
        $pembagian = Pembagian::findorfail($id);
        $tahun = Tahun::orderBy('id','DESC')->first();
        $kkm = KKM::where('kelas_id',$pembagian->kelas_id)->where('mapel_kode',$pembagian->mapel_kode)->where('tahun_id',$tahun->id)->first();
        $des = Predikat::where('kelas_id',$pembagian->kelas_id)->where('mapel_kode',$pembagian->mapel_kode)->where('tahun_id',$tahun->id)->first();
        if ($kkm || $des != null) {
            return view('guru.kkm.edit',compact('kkm','des'));
        } else {
            return redirect()->back()->with('error', 'KKM Belum Diinput!');
        }
    }

    public function update(Request $request){
        $kkm = KKM::findorfail($request->kkm_id);
        $kkm->kkm = $request->kkm;
        $kkm->update();

        $des = Predikat::findorfail($request->des_id);
        $des->a = $request->a;
        $des->b = $request->b;
        $des->c = $request->c;
        $des->d = $request->d;
        $des->dpa = $request->dpa;
        $des->dpb = $request->dpb;
        $des->dpc = $request->dpc;
        $des->dpd = $request->dpd;
        $des->dka = $request->dka;
        $des->dkb = $request->dkb;
        $des->dkc = $request->dkc;
        $des->dkd = $request->dkd;
        $des->update();
        return redirect()->back()->with('success', 'Berhasil update data kkm!');
    }
}
