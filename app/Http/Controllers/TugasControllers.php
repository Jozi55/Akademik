<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\KKM;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pembagian;
use App\Models\Predikat;
use App\Models\Raport;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Tugas;
use App\Models\Ulangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasControllers extends Controller
{
    public function index(){
        $tahun = Tahun::orderBy('id','DESC')->first();
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $mapel1 = Mapel::where('nama','matematika')->first();
        $mapel2 = Mapel::where('nama','penjas teori')->first();
        $pembagian = Pembagian::where('guru_id',$guru->id)->whereNotIn('mapel_kode',[$mapel1->kode])->whereNotIn('mapel_kode',[$mapel2->kode])->where('tahun_id',$tahun->id)->get();
        return view('guru.tugas.index',compact('guru','pembagian')); 
    }

    public function tambah(Request $request,$id){
        $pembagian = Pembagian::findorfail($id);
        $siswa = Siswa::where('kelas_id',$pembagian->kelas_id)->where('status','aktif')->get();
        $sw = Siswa::where('kelas_id',$pembagian->kelas_id)->where('status','aktif')->first();

        $tahun = Tahun::orderBy('id','DESC')->first();
        $tugas = Tugas::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();
        $tu_i = Tugas::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('siswa_id',$sw->id)->where('tahun_id',$tahun->id)->get();

        $rapot = Raport::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();

        $nilai = Nilai::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();
        return view('guru.tugas.tambah',compact('pembagian','siswa','tahun','tugas','nilai','rapot','tu_i'));
    }

    public function simpan(Request $request){
        $tahun = Tahun::orderBy('id','DESC')->first();
        foreach ($request->siswa_id as $key => $value) {
            $tugas = new Tugas();
            $tugas->mapel_kode = $request->mapels;
            $tugas->tahun_id = $request->tahun;
            $tugas->kelas_id = $request->kelas;
            $tugas->siswa_id = $value;
            $tugas->ke = $request->ke;
            $tugas->nilai = $request->nilai[$key];
            $tugas->save();

            $tugas = Tugas::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->sum('nilai');
            $bagi = Tugas::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->count('ke');

            
            $uh = Ulangan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->where('keterangan','uh')->sum('nilai');
            $bagi_uh = Ulangan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->where('keterangan','uh')->count('ke');

            $pts = Ulangan::where('keterangan','pts')->where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->sum('nilai');
            $pas = Ulangan::where('keterangan','pas')->where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->sum('nilai');

            $kkm = KKM::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $deskripsi = Predikat::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $n_tugas = ($tugas/$bagi);
            $t_tugas = ($n_tugas * (40/100));

            if ($uh > 0) {
                //Nilai Ulangan Harian
                $n_uh = ($uh/$bagi_uh);
                $t_uh = ($n_uh * 60/100);
            }else {
                $n_uh = 0;
                $t_uh = 0;
            }
            
            //Nilai PTS
            $n_pts = ($pts * (25/100));
            //Nilai PAS
            $n_pas = ($pas * (25/100));

            if ($request->nilai_id== null) {
                $n = new Nilai();
                $n->t_tugas = $n_tugas;
                $n->t_nilai = $n->t_uh + $n->t_tugas + $n->t_pts + $n->t_pas;
                $n->n_akhir = ((($t_uh  + $t_tugas) * 50/100) + $n_pts + $n_pas);
                $n->mapel_kode = $request->mapels;
                $n->tahun_id = $request->tahun;
                $n->kelas_id = $request->kelas;
                $n->siswa_id = $value;
                $n->save();

                if ($request->rapot_id == null) {
                    $rapot = new Raport();
                    if ($n->n_akhir >= $deskripsi->a && $n->n_akhir <= 100) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpa;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'A';
                        $rapot->save();
                    }elseif ($n->n_akhir >= $deskripsi->b and $n->n_akhir < $deskripsi->a) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'B';
                        $rapot->save();
                    }elseif ($n->n_akhir >= $deskripsi->c and $n->n_akhir < $deskripsi->b) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'C';
                        $rapot->save();
                    }else{
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'D';
                        $rapot->save();
                    }   
                } else {
                   $rapot = Raport::findorfail($request->rapot_id[$key]);
                    if ($n->n_akhir >= $deskripsi->a && $n->n_akhir <= 100) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpa;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'A';
                        $rapot->update();
                    }elseif ($n->n_akhir >= $deskripsi->b and $n->n_akhir < $deskripsi->a) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'B';
                        $rapot->update();
                    }elseif ($n->n_akhir >= $deskripsi->c and $n->n_akhir < $deskripsi->b) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'C';
                        $rapot->update();
                    }else{
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'D';
                        $rapot->update();
                    }
                }
            } else {
                $n = Nilai::findorfail($request->nilai_id[$key]);
                $n->t_tugas = $n_tugas;
                $n->t_nilai = $n->t_uh + $n->t_tugas + $n->t_pts + $n->t_pas;
                $n->n_akhir = ((($t_uh  + $t_tugas) * 50/100) + $n_pts + $n_pas);
                $n->mapel_kode = $request->mapels;
                $n->tahun_id = $request->tahun;
                $n->kelas_id = $request->kelas;
                $n->siswa_id = $value;
                $n->update();
                if ($request->rapot_id == null) {
                    $rapot = new Raport();
                    if ($n->n_akhir >= $deskripsi->a && $n->n_akhir <= 100) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpa;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'A';
                        $rapot->save();
                    }elseif ($n->n_akhir >= $deskripsi->b and $n->n_akhir < $deskripsi->a) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'B';
                        $rapot->save();
                    }elseif ($n->n_akhir >= $deskripsi->c and $n->n_akhir < $deskripsi->b) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'C';
                        $rapot->save();
                    }else{
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'D';
                        $rapot->save();
                    }   
                } else {
                   $rapot = Raport::findorfail($request->rapot_id[$key]);
                    if ($n->n_akhir >= $deskripsi->a && $n->n_akhir <= 100) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpa;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'A';
                        $rapot->update();
                    }elseif ($n->n_akhir >= $deskripsi->b and $n->n_akhir < $deskripsi->a) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'B';
                        $rapot->update();
                    }elseif ($n->n_akhir >= $deskripsi->c and $n->n_akhir < $deskripsi->b) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'C';
                        $rapot->update();
                    }else{
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $value;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'D';
                        $rapot->update();
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Berhasil menambah data nilai!');
    }

    public function edit(Request $request,$id){
        $ke = $request->ke;
        $pembagian = Pembagian::findorfail($id);
        $siswa = Siswa::where('kelas_id',$pembagian->kelas_id)->where('status','aktif')->get();
        $tahun = Tahun::orderBy('id','DESC')->first();
        $rapot = Raport::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();
        $tg = Tugas::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->where('ke',$ke)->first();

        $tugas = Tugas::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->where('ke',$ke)->get();
        $nilai = Nilai::where('mapel_kode',$pembagian->mapel_kode)->where('kelas_id',$pembagian->kelas_id)->where('tahun_id',$tahun->id)->get();
        return view('guru.tugas.edit',compact('tahun','pembagian','tugas','tg','nilai','siswa','rapot'));
    }

    public function update(Request $request){
        $tahun = Tahun::orderBy('id','DESC')->first();
        foreach ($request->siswa_id as $key => $value) {
            $tugas = Tugas::findorfail($request->tugas_id[$key]);
            $tugas->mapel_kode = $request->mapels;
            $tugas->tahun_id = $request->tahun;
            $tugas->kelas_id = $request->kelas;
            $tugas->siswa_id = $value;
            $tugas->ke = $request->ke;
            $tugas->nilai = $request->nilai[$key];
            $tugas->update();

            $tugas = Tugas::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->sum('nilai');
            $bagi = Tugas::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->count('ke');

            
            $uh = Ulangan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->where('keterangan','uh')->sum('nilai');
            $bagi_uh = Ulangan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->where('keterangan','uh')->count('ke');

            $pts = Ulangan::where('keterangan','pts')->where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->sum('nilai');
            $pas = Ulangan::where('keterangan','pas')->where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('siswa_id',$value)->where('tahun_id',$tahun->id)->sum('nilai');

            $kkm = KKM::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $deskripsi = Predikat::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $n_tugas = ($tugas/$bagi);
            $t_tugas = ($n_tugas * (40/100));

            if ($uh > 0) {
                //Nilai Ulangan Harian
                $n_uh = ($uh/$bagi_uh);
                $t_uh = ($n_uh * 60/100);
            }else {
                $n_uh = 0;
                $t_uh = 0;
            }
            
            //Nilai PTS
            $n_pts = ($pts * (25/100));
            //Nilai PAS
            $n_pas = ($pas * (25/100));
            
                $n = Nilai::findorfail($request->nilai_id[$key]);
                $n->t_tugas = $n_tugas;
                $n->t_tugas = $n_tugas;
                $n->t_nilai = $n->t_uh + $n->t_tugas + $n->t_pts + $n->t_pas;
                $n->n_akhir = ((($t_uh  + $t_tugas) * 50/100) + $n_pts + $n_pas);
                $n->mapel_kode = $request->mapels;
                $n->tahun_id = $request->tahun;
                $n->kelas_id = $request->kelas;
                $n->siswa_id = $value;
                $n->update();
                
                $rapot = Raport::findorfail($request->rapot_id[$key]);
                if ($n->n_akhir >= $deskripsi->a && $n->n_akhir <= 100) {
                    $rapot->nilai_p = $n->n_akhir;
                    $rapot->deskripsi_p = $deskripsi->dpa;
                    $rapot->mapel_kode = $request->mapels;
                    $rapot->tahun_id = $request->tahun;
                    $rapot->kelas_id = $request->kelas;
                    $rapot->siswa_id = $value;
                    $rapot->kkm_id = $kkm->id;
                    $rapot->predikat_p = 'A';
                    $rapot->update();
                }elseif ($n->n_akhir >= $deskripsi->b and $n->n_akhir < $deskripsi->a) {
                    $rapot->nilai_p = $n->n_akhir;
                    $rapot->deskripsi_p = $deskripsi->dpb;
                    $rapot->mapel_kode = $request->mapels;
                    $rapot->tahun_id = $request->tahun;
                    $rapot->kelas_id = $request->kelas;
                    $rapot->siswa_id = $value;
                    $rapot->kkm_id = $kkm->id;
                    $rapot->predikat_p = 'B';
                    $rapot->update();
                }elseif ($n->n_akhir >= $deskripsi->c and $n->n_akhir < $deskripsi->b) {
                    $rapot->nilai_p = $n->n_akhir;
                    $rapot->deskripsi_p = $deskripsi->dpc;
                    $rapot->mapel_kode = $request->mapels;
                    $rapot->tahun_id = $request->tahun;
                    $rapot->kelas_id = $request->kelas;
                    $rapot->siswa_id = $value;
                    $rapot->kkm_id = $kkm->id;
                    $rapot->predikat_p = 'C';
                    $rapot->update();
                }else{
                    $rapot->nilai_p = $n->n_akhir;
                    $rapot->deskripsi_p = $deskripsi->dpd;
                    $rapot->mapel_kode = $request->mapels;
                    $rapot->tahun_id = $request->tahun;
                    $rapot->kelas_id = $request->kelas;
                    $rapot->siswa_id = $value;
                    $rapot->kkm_id = $kkm->id;
                    $rapot->predikat_p = 'D';
                    $rapot->update();
                }
            }

        return redirect()->back()->with('success', 'Berhasil update data nilai!');
    }

    public function simpanTambah(Request $request){
        $tahun = Tahun::orderBy('id','DESC')->first();
            $tugas = new Tugas();
            $tugas->mapel_kode = $request->mapels;
            $tugas->tahun_id = $request->tahun;
            $tugas->kelas_id = $request->kelas;
            $tugas->siswa_id = $request->siswa_id;
            $tugas->ke = $request->ke;
            $tugas->nilai = $request->nilai;
            $tugas->save();

            $tugas = Tugas::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$request->siswa_id)->where('tahun_id',$tahun->id)->sum('nilai');
            $bagi = Tugas::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$request->siswa_id)->where('tahun_id',$tahun->id)->count('ke');

            
            $uh = Ulangan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$request->siswa_id)->where('tahun_id',$tahun->id)->where('keterangan','uh')->sum('nilai');
            $bagi_uh = Ulangan::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$request->siswa_id)->where('tahun_id',$tahun->id)->where('keterangan','uh')->count('ke');

            $pts = Ulangan::where('keterangan','pts')->where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('siswa_id',$request->siswa_id)->where('tahun_id',$tahun->id)->sum('nilai');
            $pas = Ulangan::where('keterangan','pas')->where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('siswa_id',$request->siswa_id)->where('tahun_id',$tahun->id)->sum('nilai');

            $kkm = KKM::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $deskripsi = Predikat::where('kelas_id',$request->kelas)->where('mapel_kode',$request->mapels)->where('tahun_id',$tahun->id)->first();
            $n_tugas = ($tugas/$bagi);
            $t_tugas = ($n_tugas * (40/100));

            if ($uh > 0) {
                //Nilai Ulangan Harian
                $n_uh = ($uh/$bagi_uh);
                $t_uh = ($n_uh * 60/100);
            }else {
                $n_uh = 0;
                $t_uh = 0;
            }
            
            //Nilai PTS
            $n_pts = ($pts * (25/100));
            //Nilai PAS
            $n_pas = ($pas * (25/100));
            $Nilais = Nilai::where('mapel_kode',$request->mapels)->where('kelas_id',$request->kelas)->where('siswa_id',$request->siswa_id)->where('tahun_id',$tahun->id)->first();
            
            if ($Nilais == NULL) {
                $n = new Nilai();
                $n->t_tugas = $n_tugas;
                $n->t_nilai = $n->t_uh + $n->t_tugas + $n->t_pts + $n->t_pas;
                $n->n_akhir = ((($t_uh  + $t_tugas) * 50/100) + $n_pts + $n_pas);
                $n->mapel_kode = $request->mapels;
                $n->tahun_id = $request->tahun;
                $n->kelas_id = $request->kelas;
                $n->siswa_id = $request->siswa_id;
                $n->save();

                $rapot = new Raport();
                    if ($n->n_akhir >= $deskripsi->a && $n->n_akhir <= 100) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpa;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'A';
                        $rapot->save();
                    }elseif ($n->n_akhir >= $deskripsi->b and $n->n_akhir < $deskripsi->a) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'B';
                        $rapot->save();
                    }elseif ($n->n_akhir >= $deskripsi->c and $n->n_akhir < $deskripsi->b) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'C';
                        $rapot->save();
                    }else{
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'D';
                        $rapot->save();
                    }   
            } else {
                $n = Nilai::findorfail($request->nilai_id);
                $n->t_tugas = $n_tugas;
                $n->t_nilai = $n->t_uh + $n->t_tugas + $n->t_pts + $n->t_pas;
                $n->n_akhir = ((($t_uh  + $t_tugas) * 50/100) + $n_pts + $n_pas);
                $n->mapel_kode = $request->mapels;
                $n->tahun_id = $request->tahun;
                $n->kelas_id = $request->kelas;
                $n->siswa_id = $request->siswa_id;
                $n->update();
                if ($request->rapot_id == null) {
                    $rapot = new Raport();
                    if ($n->n_akhir >= $deskripsi->a && $n->n_akhir <= 100) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpa;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'A';
                        $rapot->save();
                    }elseif ($n->n_akhir >= $deskripsi->b and $n->n_akhir < $deskripsi->a) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'B';
                        $rapot->save();
                    }elseif ($n->n_akhir >= $deskripsi->c and $n->n_akhir < $deskripsi->b) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'C';
                        $rapot->save();
                    }else{
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'D';
                        $rapot->save();
                    }   
                } else {
                   $rapot = Raport::findorfail($request->rapot_id);
                    if ($n->n_akhir >= $deskripsi->a && $n->n_akhir <= 100) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpa;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'A';
                        $rapot->update();
                    }elseif ($n->n_akhir >= $deskripsi->b and $n->n_akhir < $deskripsi->a) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpb;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'B';
                        $rapot->update();
                    }elseif ($n->n_akhir >= $deskripsi->c and $n->n_akhir < $deskripsi->b) {
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpc;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'C';
                        $rapot->update();
                    }else{
                        $rapot->nilai_p = $n->n_akhir;
                        $rapot->deskripsi_p = $deskripsi->dpd;
                        $rapot->mapel_kode = $request->mapels;
                        $rapot->tahun_id = $request->tahun;
                        $rapot->kelas_id = $request->kelas;
                        $rapot->siswa_id = $request->siswa_id;
                        $rapot->kkm_id = $kkm->id;
                        $rapot->predikat_p = 'D';
                        $rapot->update();
                    }
                }
            }

        return redirect()->back()->with('success', 'Berhasil menambah data nilai!');
    }
}
