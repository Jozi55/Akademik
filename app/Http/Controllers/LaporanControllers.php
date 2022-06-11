<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Kepala;
use App\Models\Nilai;
use App\Models\Raport;
use App\Models\Sikap;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class LaporanControllers extends Controller
{
    public function index(){
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $kelas = Wali::where('guru_id',$guru->id)->first();
        $siswa = Siswa::where('kelas_id',$kelas->id)->where('status','aktif')->get();
        $nilai = Nilai::where('kelas_id',$kelas->id)->get();
        return view('guru.laporan.index',compact('siswa','nilai'));
    }

    public function view($id){
        $tahun = Tahun::orderBy('id','DESC')->first();
        $nilai = Nilai::where('siswa_id',$id)->where('tahun_id',$tahun->id)->get();

        return view('guru.laporan.view',compact('nilai'));
    }


    public function cetak($id){
        $siswa = Siswa::findorfail($id);
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $tahun = Tahun::orderBy('id','DESC')->first();
        $kelas = Wali::where('guru_id',$guru->id)->first();
        $rapot = Raport::where('siswa_id',$siswa->id)->where('tahun_id',$tahun->id)->orderBy('mapel_kode','ASC')->get();
        $sikap = Sikap::where('siswa_id',$siswa->id)->where('tahun_id',$tahun->id)->get();
        $sakit = Absen::where('siswa_id',$siswa->id)->where('kelas_id',$siswa->kelas_id)->where('tahun_id',$tahun->id)->where('keterangan','Sakit')->count('pertemuan');   
        $izin = Absen::where('siswa_id',$siswa->id)->where('kelas_id',$siswa->kelas_id)->where('tahun_id',$tahun->id)->where('keterangan','Izin')->count('pertemuan'); 
        $tk = Absen::where('siswa_id',$siswa->id)->where('kelas_id',$siswa->kelas_id)->where('tahun_id',$tahun->id)->where('keterangan','Tanpa Keterangan')->count('pertemuan');  
        $kepala = Kepala::orderBy('id','DESC')->first();
        
        $pdf = PDF::loadview('guru.laporan.rapot',compact('rapot','sikap','kelas','siswa','tahun','sakit','izin','tk','kepala'))->setpaper('a4','portrait');
        return $pdf->stream('Rapor '.$siswa->nama.'.pdf');
    }

    // Admin
    
    public function admin_index(){
        $kelas = Kelas::all();
        return view('admin.nilai.index',compact('kelas'));
    }

    public function cari(Request $request,$id){
        $nama = $request->nama;
        $status = $request->status;
        $kelas = Kelas::findorfail($id);
        $tahun = Tahun::all();

        $siswa = Siswa::with('kelas')->where('kelas_id',$id)->where('status','aktif')->get();
        
        if ( $nama ||$status) {
            $siswa = Siswa::with('kelas')->where('kelas_id','LIKE',"%".$kelas->id."%")
                ->where('nama','LIKE',"%".$nama."%")
                ->where('status','LIKE',"%".$status."%")
                ->get();
            return view('admin.nilai.siswa',compact('siswa','kelas','tahun'));
        }else {
            return view('admin.nilai.siswa',compact('siswa','kelas','tahun'));
        }
    }

    public function siswa($id){
        $kelas = Kelas::findorfail($id);
        $siswa = Siswa::where('kelas_id',$kelas->id)->where('status','aktif')->get();
        $tahun = Tahun::all();
        return view('admin.nilai.siswa',compact('siswa','tahun','kelas'));
    }

    public function admin_nilai(Request $request,$id){
        $tahun = $request->tahun;
        $nilai = Nilai::where('siswa_id',$id)->where('tahun_id',$tahun)->get();
        $n = Nilai::where('siswa_id',$id)->where('tahun_id',$tahun)->first();
        return view('admin.nilai.nilai',compact('nilai','n'));
    }

    public function admin_cetak(Request $request,$id){
        $tahun = $request->tahun;
        $siswa = Siswa::findorfail($id);
        $n = Raport::where('siswa_id',$id)->where('tahun_id',$tahun)->first();
        $rapot = Raport::where('siswa_id',$id)->where('tahun_id',$tahun)->orderBy('mapel_kode','ASC')->get();
        $sikap = Sikap::where('siswa_id',$id)->where('tahun_id',$tahun)->get();
        $sakit = Absen::where('siswa_id',$id)->where('tahun_id',$tahun)->where('keterangan','Sakit')->count('pertemuan');   
        $izin = Absen::where('siswa_id',$id)->where('tahun_id',$tahun)->where('keterangan','Izin')->count('pertemuan'); 
        $tk = Absen::where('siswa_id',$id)->where('tahun_id',$tahun)->where('keterangan','Tanpa Keterangan')->count('pertemuan');  
        $kepala = Kepala::orderBy('id','DESC')->first();
        
        $pdf = PDF::loadview('admin.nilai.rapot',compact('rapot','sikap','n','sakit','izin','tk','kepala','siswa'))->setpaper('a4','portrait');
        return $pdf->stream('Rapor '.$siswa->nama.'.pdf');

    }
}
