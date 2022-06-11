<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Keterampilan;
use App\Models\Nilai;
use App\Models\Raport;
use App\Models\Sikap;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Ulangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SiswaControllers extends Controller
{
    public function index(){
        $siswa = Siswa::where('status','aktif')->orderBy('kelas_id','ASC')->paginate(10);
        $kelas = Kelas::get();
        return view('admin.siswa.index',compact('siswa','kelas'));
    }

    public function cari(Request $request){
        $kls = $request->kelas;
        $nama = $request->nama;
        $status = $request->status;

        $kelas = Kelas::get();
        $siswa = Siswa::where('status','aktif')->orderBy('kelas_id','ASC')->paginate(10);
        if ($kls  && $nama && $status) {
            
            $siswa = Siswa::where('kelas_id',$kls)
                ->where('nama','LIKE',"%".$nama."%")
                ->where('status',$status)
                ->orderBy('kelas_id','ASC')
                ->get();
            $siswa->appends(['kls' => $kls,'nama'=>$nama,'status'=>$status]);
            return view('admin.siswa.index',compact('siswa','kelas'));

        }elseif($kls && $nama){

            $siswa = Siswa::where('kelas_id',$kls)
                ->where('nama','LIKE',"%".$nama."%")
                ->orderBy('kelas_id','ASC')
                ->paginate(40);
            $siswa->appends(['kls' => $kls,'nama'=>$nama]);
            return view('admin.siswa.index',compact('siswa','kelas'));

        }elseif($kls && $status){
            $siswa = Siswa::where('kelas_id',$kls)
                ->where('status',$status)
                ->orderBy('kelas_id','ASC')
                ->paginate(40);
            $siswa->appends(['kls' => $kls,'status'=>$status]);
            return view('admin.siswa.index',compact('siswa','kelas'));

        }elseif($nama && $status){

            $siswa = Siswa::where('nama','LIKE',"%".$nama."%")
                ->where('status',$status)
                ->orderBy('kelas_id','ASC')
                ->paginate(40);
            $siswa->appends(['nama'=>$nama,'status'=>$status]);
            return view('admin.siswa.index',compact('siswa','kelas'));

        }elseif($kls){

            $siswa = Siswa::where('kelas_id',$kls)
                ->orderBy('kelas_id','ASC')
                ->paginate(40);
            $siswa->appends(['kls' => $kls]);
            return view('admin.siswa.index',compact('siswa','kelas'));

        }elseif($nama){

            $siswa = Siswa::where('nama','LIKE',"%".$nama."%")
                ->orderBy('kelas_id','ASC')
                ->paginate(40);
            $siswa->appends(['nama'=>$nama]);
            return view('admin.siswa.index',compact('siswa','kelas'));

        }elseif($status){

            $siswa = Siswa::where('status',$status)
                ->orderBy('kelas_id','ASC')
                ->paginate(40);
            $siswa->appends(['nama'=>$nama]);
            return view('admin.siswa.index',compact('siswa','kelas'));

        }else {
            return view('admin.siswa.index',compact('siswa','kelas'));
        }
    }

    public function tambah(){
        $kelas = Kelas::get();
        return view('admin.siswa.tambah',compact('kelas'));
    }

    public function simpan(Request $request){
        $siswa = new Siswa();
        $siswa->nisn = $request->nisn;
        $siswa->nis = $request->nis;
        $siswa->nama = ucwords($request->nama);
        $siswa->alamat = ucwords($request->alamat);
        $siswa->tmp = ucwords($request->tmp);
        $siswa->tgl = $request->tgl;
        $siswa->agama = $request->agama;
        $siswa->jk = $request->jk;
        $siswa->ayah = ucwords($request->ayah);
        $siswa->ibu = ucwords($request->ibu);
        $siswa->tlp = $request->tlp;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->status = $request->status;
        $siswa->save();
        return redirect()->back()->with('success', 'Berhasil menambah data siswa!');
    }

    public function edit($id){
        $siswa = Siswa::findorfail($id);
        $kelas = Kelas::get();
        return view('admin.siswa.edit',compact('siswa','kelas'));
    }

    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'nisn' => 'unique:siswas,nisn,' .$id,
            'nis' => 'unique:siswas,nis,' .$id,
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'NISN atau NIS yang di input sudah ada!');
        }else{
        $siswa = Siswa::findorfail($id);
        $siswa->nisn = $request->nisn;
        $siswa->nis = $request->nis;
        $siswa->nama = ucwords($request->nama);
        $siswa->alamat = ucwords($request->alamat);
        $siswa->tmp = ucwords($request->tmp);
        $siswa->tgl = $request->tgl;
        $siswa->agama = $request->agama;
        $siswa->jk = $request->jk;
        $siswa->ayah = ucwords($request->ayah);
        $siswa->ibu = ucwords($request->ibu);
        $siswa->tlp = $request->tlp;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->status = $request->status;
        $siswa->update();
        return redirect()->back()->with('success', 'Berhasil update data siswa!');
        }
    }

    // public function hapus($id){
    //     $siswa = Siswa::findorfail($id);
    //     $nilai = Nilai::where('siswa_id',$siswa->id);
    //     $ulang = Ulangan::where('siswa_id',$siswa->id);
    //     $absensi = Absen::where('siswa_id',$siswa->id);
    //     $rapot = Raport::where('siswa_id',$siswa->id);
    //     $keterampilan = Keterampilan::where('siswa_id',$siswa->id);
    //     $sikap = Sikap::where('siswa_id',$siswa->id);
    //     $tugas = Tugas::where('siswa_id',$siswa->id);

    //     $tugas->delete();
    //     $sikap->delete();
    //     $keterampilan->delete();
    //     $rapot->delete();
    //     $ulang->delete();
    //     $nilai->delete();
    //     $absensi->delete();
    //     $siswa->delete();
    //     return redirect()->back()->with('success', 'Berhasil hapus data siswa!');
    // }
}
