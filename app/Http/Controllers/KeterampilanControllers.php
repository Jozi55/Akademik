<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Keterampilan;
use App\Models\KKM;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pembagian;
use App\Models\Predikat;
use App\Models\Raport;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeterampilanControllers extends Controller
{
    public function index(){
        $tahun = Tahun::orderBy('id','DESC')->first();
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $mapel1 = Mapel::where('nama','matematika')->first();
        $mapel2 = Mapel::where('nama','penjas teori')->first();
        $pembagian = Pembagian::where('guru_id',$guru->id)->whereNotIn('mapel_kode',[$mapel1->kode])->whereNotIn('mapel_kode',[$mapel2->kode])->where('tahun_id',$tahun->id)->get();
        return view('guru.keterampilan.index',compact('guru','pembagian')); 
    }

    public function tambah(Request $request,$id){
        $pembagian = Pembagian::findorfail($id);
        $siswa = Siswa::where('kelas_id',$pembagian->kelas_id)->where('status','aktif')->get();
        $tahun = Tahun::orderBy('id','DESC')->first();
        $nilai = Nilai::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();
        $rapot = Raport::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();

        $keterampilan = Keterampilan::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();
        return view('guru.keterampilan.tambah',compact('pembagian','siswa','tahun','keterampilan','nilai','rapot'));
    }

    public function simpan(Request $request){
        $tahun = Tahun::orderBy('id','DESC')->first();
        foreach ($request->siswa_id as $key => $value) {
            $keterampilan = new Keterampilan();
            $keterampilan->mapel_kode = $request->mapels;
            $keterampilan->tahun_id = $request->tahun;
            $keterampilan->kelas_id = $request->kelas;
            $keterampilan->siswa_id = $value;
            $keterampilan->kd = $request->kd;
            $keterampilan->nilai = $request->nilai[$key];
            $keterampilan->save();

            $keterampilan = Keterampilan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->sum('nilai');
            $bagi = Keterampilan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->count('kd');
            $kkm = KKM::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $deskripsi = Predikat::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $n_kt = ($keterampilan/$bagi);

            if ($request->nilai_id== null) {
                $n = new Nilai();
                $n->k_nilai = $keterampilan;
                $n->k_akhir = $n_kt;
                $n->mapel_kode = $request->mapels;
                $n->tahun_id = $request->tahun;
                $n->kelas_id = $request->kelas;
                $n->siswa_id = $value;
                $n->save();

                if ($request->rapot_id == null) {
                    $rapot = new Raport();
                    if ($n->k_akhir >= $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dka;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'A';
                        $rapot->save();
                    }elseif ($n->k_akhir >= $deskripsi->b and $n->k_akhir < $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'B';
                        $rapot->save();
                    }elseif ($n->k_akhir >= $deskripsi->c and $n->k_akhir < $deskripsi->b) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'C';
                        $rapot->save();
                    }else{
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'D';
                        $rapot->save();
                    }   
                } else {
                   $rapot = Raport::findorfail($request->rapot_id[$key]);
                    if ($n->k_akhir >= $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dka;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'A';
                        $rapot->update();
                    }elseif ($n->k_akhir >= $deskripsi->b and $n->k_akhir < $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'B';
                        $rapot->update();
                    }elseif ($n->k_akhir >= $deskripsi->c and $n->k_akhir < $deskripsi->b) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'C';
                        $rapot->update();
                    }else{
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'D';
                        $rapot->update();
                    }
                }
            } else {
                $n = Nilai::findorfail($request->nilai_id[$key]);
                $n->k_nilai = $keterampilan;
                $n->k_akhir = $n_kt;
                $n->mapel_kode = $request->mapels;
                $n->tahun_id = $request->tahun;
                $n->kelas_id = $request->kelas;
                $n->siswa_id = $value;
                $n->update();

                if ($request->rapot_id == null) {
                    $rapot = new Raport();
                    if ($n->k_akhir >= $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dka;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'A';
                        $rapot->save();
                    }elseif ($n->k_akhir >= $deskripsi->b and $n->k_akhir < $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'B';
                        $rapot->save();
                    }elseif ($n->k_akhir >= $deskripsi->c and $n->k_akhir < $deskripsi->b) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'C';
                        $rapot->save();
                    }else{
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'D';
                        $rapot->save();
                    }   
                } else {
                   $rapot = Raport::findorfail($request->rapot_id[$key]);
                    if ($n->k_akhir >= $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dka;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'A';
                        $rapot->update();
                    }elseif ($n->k_akhir >= $deskripsi->b and $n->k_akhir < $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'B';
                        $rapot->update();
                    }elseif ($n->k_akhir >= $deskripsi->c and $n->k_akhir < $deskripsi->b) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'C';
                        $rapot->update();
                    }else{
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'D';
                        $rapot->update();
                    }
                }
            }
            
        }

        return redirect()->back()->with('success', 'Berhasil menambah data nilai!');
    }

    public function edit(Request $request,$id){
        $kd = $request->kd;
        $pembagian = Pembagian::findorfail($id);
        $siswa = Siswa::where('kelas_id',$pembagian->kelas_id)->where('status','aktif')->get();
        $tahun = Tahun::orderBy('id','DESC')->first();
        $kt = Keterampilan::where('mapel_kode',$pembagian->mapel_kode)->where('tahun_id',$tahun->id)->where('kd',$kd)->first();
        $rapot = Raport::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();

        $keterampilan = Keterampilan::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->where('kd',$kd)->get();
        $nilai = Nilai::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();
        return view('guru.keterampilan.edit',compact('tahun','pembagian','keterampilan','kt','nilai','siswa','rapot'));
    }

    public function update(Request $request){
        $tahun = Tahun::orderBy('id','DESC')->first();
        foreach ($request->siswa_id as $key => $value) {
            $keterampilan = Keterampilan::findorfail($request->keterampilan_id[$key]);
            $keterampilan->mapel_kode = $request->mapels;
            $keterampilan->tahun_id = $request->tahun;
            $keterampilan->kelas_id = $request->kelas;
            $keterampilan->siswa_id = $value;
            $keterampilan->kd = $request->kd;
            $keterampilan->nilai = $request->nilai[$key];
            $keterampilan->save();

            $keterampilan = Keterampilan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->sum('nilai');
            $bagi = Keterampilan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->count('kd');
            $kkm = KKM::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $deskripsi = Predikat::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $n_kt = ($keterampilan/$bagi);

            if ($request->nilai_id== null) {
                $n = new Nilai();
                $n->k_nilai = $keterampilan;
                $n->k_akhir = $n_kt;
                $n->mapel_kode = $request->mapels;
                $n->tahun_id = $request->tahun;
                $n->kelas_id = $request->kelas;
                $n->siswa_id = $value;
                $n->save();

                if ($request->rapot_id == null) {
                    $rapot = new Raport();
                    if ($n->k_akhir >= $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dka;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'A';
                        $rapot->save();
                    }elseif ($n->k_akhir >= $deskripsi->b and $n->k_akhir < $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'B';
                        $rapot->save();
                    }elseif ($n->k_akhir >= $deskripsi->c and $n->k_akhir < $deskripsi->b) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'C';
                        $rapot->save();
                    }else{
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'D';
                        $rapot->save();
                    }   
                } else {
                   $rapot = Raport::findorfail($request->rapot_id[$key]);
                    if ($n->k_akhir >= $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dka;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'A';
                        $rapot->update();
                    }elseif ($n->k_akhir >= $deskripsi->b and $n->k_akhir < $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'B';
                        $rapot->update();
                    }elseif ($n->k_akhir >= $deskripsi->c and $n->k_akhir < $deskripsi->b) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'C';
                        $rapot->update();
                    }else{
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'D';
                        $rapot->update();
                    }
                }
            } else {
                $n = Nilai::findorfail($request->nilai_id[$key]);
                $n->k_nilai = $keterampilan;
                $n->k_akhir = $n_kt;
                $n->mapel_kode = $request->mapels;
                $n->tahun_id = $request->tahun;
                $n->kelas_id = $request->kelas;
                $n->siswa_id = $value;
                $n->update();

                if ($request->rapot_id == null) {
                    $rapot = new Raport();
                    if ($n->k_akhir >= $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dka;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'A';
                        $rapot->save();
                    }elseif ($n->k_akhir >= $deskripsi->b and $n->k_akhir < $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'B';
                        $rapot->save();
                    }elseif ($n->k_akhir >= $deskripsi->c and $n->k_akhir < $deskripsi->b) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'C';
                        $rapot->save();
                    }else{
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'D';
                        $rapot->save();
                    }   
                } else {
                   $rapot = Raport::findorfail($request->rapot_id[$key]);
                    if ($n->k_akhir >= $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dka;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'A';
                        $rapot->update();
                    }elseif ($n->k_akhir >= $deskripsi->b and $n->k_akhir < $deskripsi->a) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'B';
                        $rapot->update();
                    }elseif ($n->k_akhir >= $deskripsi->c and $n->k_akhir < $deskripsi->b) {
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'C';
                        $rapot->update();
                    }else{
                        $rapot->nilai_k = $n->k_akhir;
                        $rapot->deskripsi_k = $deskripsi->dkd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_k = 'D';
                        $rapot->update();
                    }
                }
            }
            
        }

        return redirect()->back()->with('success', 'Berhasil update data nilai!');
    }

}
