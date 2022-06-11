<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pembagian;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class AbsenControllers extends Controller
{
    public function index(){
        $tahun = Tahun::orderBy('id','DESC')->first();
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $pembagian = Pembagian::where('guru_id',$guru->id)->where('tahun_id',$tahun->id)->get();
        return view('guru.absensi.index',compact('guru','pembagian'));
    }

    public function tambah($id){
        $pembagian = Pembagian::findorfail($id);
        $siswa = Siswa::where('kelas_id',$pembagian->kelas_id)->where('status','aktif')->get();
        $tahun = Tahun::orderBy('id','DESC')->first();

        return view('guru.absensi.input',compact('siswa','pembagian','tahun'));
    }

    public function simpan(Request $request){
        foreach ($request->keterangan as $key => $value) {
            $absensi = new Absen();
            $absensi->tgl = $request->tgl;
            $absensi->tahun_id = $request->tahun;
            $absensi->mapel_kode = $request->mapel;
            $absensi->siswa_id = $request->siswa[$key];
            $absensi->keterangan = $value;
            $absensi->kelas_id = $request->kelas;
            $absensi->pertemuan = $request->pertemuan;

            $absensi->save();
        }
        return redirect()->back()->with('success', 'Berhasil menambah data absensi!');
    }

    public function view($id){
        $tahun = Tahun::orderBy('id','DESC')->first();
        $pembagian = Pembagian::findorfail($id);
        $absensi = Absen::where('kelas_id',$pembagian->kelas_id)->where('mapel_kode',$pembagian->mapel_kode)->where('tahun_id',$tahun->id)->paginate(10);
    

        return view('guru.absensi.view',compact('absensi','pembagian'));
    }

    public function edit(Request $request,$id){
        $pA = $request->pertemuan;
        $pembagian = Pembagian::findorfail($id);
        $tahun = Tahun::orderBy('id','DESC')->first();
        $pertemuan = Absen::where('mapel_kode',$pembagian->mapel_kode)->where('tahun_id',$tahun->id)->where('pertemuan',$pA)->first();
        $absensi = Absen::where('mapel_kode',$pembagian->mapel_kode)->where('tahun_id',$tahun->id)->where('pertemuan',$pA)->get();
        $siswa = Siswa::where('kelas_id',$pembagian->kelas_id)->where('status','aktif')->get();
        return view('guru.absensi.edit',compact('tahun','absensi','pertemuan','siswa','pembagian'));
    }

    public function update(Request $request){
        foreach ($request->siswa as $key => $value) {
            $absensi = Absen::findorfail($request->pertemuan_id[$key]);
            $absensi->siswa_id = $value;
            $absensi->keterangan = $request->keterangan[$key];
            $absensi->tgl = $request->tgl;
            $absensi->pertemuan = $request->pertemuan;
            $absensi->update();
        }
        return redirect()->back()->with('success', 'Berhasil menambah update absensi!');
    }

    public function cari(Request $request,$id){
        $pA = $request->pertemuan;
        $pembagian = Pembagian::findorfail($id);
        $tahun = Tahun::orderBy('id','DESC')->first();
        $absensi = Absen::where('kelas_id',$pembagian->kelas_id)->where('mapel_kode',$pembagian->mapel_kode)->where('pertemuan',$pA)->where('tahun_id',$tahun->id)->paginate(10);
        $absensi->appends(['pertemuan' => $pA]);

        return view('guru.absensi.view',compact('absensi','pembagian'));
    }

    public function pdf(Request $request,$id){
        $pA = $request->pA;
        $pembagian = Pembagian::findorfail($id);
        $tahun = Tahun::orderBy('id','DESC')->first();
        $absensi = Absen::where('kelas_id',$pembagian->kelas_id)->where('mapel_kode',$pembagian->mapel_kode)->where('pertemuan',$pA)->where('tahun_id',$tahun->id)->get();
        $cek = Absen::where('kelas_id',$pembagian->kelas_id)->where('mapel_kode',$pembagian->mapel_kode)->where('pertemuan',$pA)->where('tahun_id',$tahun->id)->first();

        if ($cek == NULL) {
            return redirect()->back()->with('error', 'Absensi Belum Diinput');
        } else {
            $pdf = PDF::loadview('guru.absensi.pdf',compact('absensi','pembagian'));
            return $pdf->stream('absensi.pdf');
        }
    }

    public function allpdf(Request $request,$id){
        $pembagian = Pembagian::findorfail($id);
        $tahun = Tahun::orderBy('id','DESC')->first();
        $absensi = Absen::where('kelas_id',$pembagian->kelas_id)->where('mapel_kode',$pembagian->mapel_kode)->where('tahun_id',$tahun->id)->get();
        $pdf = PDF::loadview('guru.absensi.allpdf',compact('absensi','pembagian','tahun'))->setpaper('a4','portrait');
        return $pdf->stream('absensi.pdf');
    }

    public function test(){
        $siswa = Siswa::where('kelas_id','4')->first();
        $kehadiran = Absen::where('kelas_id','4')->where('siswa_id',$siswa->id)->get();
        $absensi = Absen::where('kelas_id','4')->get();
        return view('guru.absensi.test',compact('kehadiran','absensi'));
    }
}
