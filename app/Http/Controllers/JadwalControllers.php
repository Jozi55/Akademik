<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pembagian;
use App\Models\Tahun;
use App\Models\User;
use App\Models\Wali;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalControllers extends Controller
{
    public function index(Request $request){
        $tahun = Tahun::orderBy('id','DESC')->get();
        $thn = Tahun::orderBy('id','DESC')->first();
        $kl = $request->kelas;
        $th = $request->tahun;
        $jadwal = Jadwal::orderBy('kelas_id','ASC')->where('tahun_id',$thn->id)->paginate(10);
        $mapel = Mapel::get();
        $kelas = Kelas::get();
        return view('admin.jadwal.index',compact('jadwal','mapel','kelas','kl','th','tahun'));
       
    }

    public function cari(Request $request){
        $kl = $request->kelas;
        $th = $request->tahun;
        $tahun = Tahun::orderBy('id','DESC')->get();
        $jadwal = Jadwal::with('kelas','mapel')->where('kelas_id',$kl)->where('tahun_id',$th)->paginate(10);
        $mapel = Mapel::get();
        $kelas = Kelas::get();
        $jadwal->appends(['kelas' => $kl,'tahun'=>$th]);

        return view('admin.jadwal.index',compact('jadwal','mapel','kelas','kl','th','tahun'));
    }

    public function tambah(Request $request){
        $mapel = Mapel::get();
        $kelas = Kelas::get();
        $guru = Guru::all();
        $tahun = Tahun::orderBy('id','DESC')->get();
        return view('admin.jadwal.tambah',compact('mapel','guru','kelas','tahun'));
    }

    public function simpan(Request $request){
        foreach ($request->jam as $key => $value) {
            $jadwal = new Jadwal();
            $jadwal->mapel_kode = $request->mapel[$key];
            $jadwal->kelas_id = $request->kelas;
            $jadwal->jam = $value;
            $jadwal->guru_id = $request->guru[$key];
            $jadwal->hari = $request->hari[$key];
            $jadwal->tahun_id = $request->tahun;
            $jadwal->save();

            $tahun = Tahun::orderBy('id','DESC')->first();
            $guru = Pembagian::where('kelas_id',$request->kelas)->where('guru_id',$request->guru[$key])->where('mapel_kode',$request->mapel[$key])->where('tahun_id',$tahun->id)->first();
            
            if ($request->guru[$key] == Null) {
               
            }elseif ($guru == NULL) {
                $pembagian = new Pembagian();
                $pembagian->guru_id = $request->guru[$key];
                $pembagian->tahun_id = $request->tahun;
                $pembagian->mapel_kode = $request->mapel[$key];
                $pembagian->kelas_id = $request->kelas;
                $pembagian->save();
                    
            } else {
                
            }
        }
        return redirect()->route('jadwal')->with('success', 'Berhasil menambah jadwal!');
            
    }

    public function edit(Request $request,$id){
        $jadwal = Jadwal::findorfail($id);
        $mapel = Mapel::all();
        $kelas = Kelas::all();
        $guru = Guru::all();

        return view('admin.jadwal.edit',compact('mapel','kelas','jadwal','guru'));
    }

    public function update(Request $request,$id){
            $jadwal = Jadwal::findorfail($id);
            $jadwal->kelas_id = $request->kelas;
            $jadwal->hari = $request->hari;
            $jadwal->jam = $request->jam;
            $jadwal->mapel_kode = $request->mapel;
            $jadwal->guru_id = $request->guru;
            $jadwal->update();

            $pembagian = Pembagian::where('kelas_id',$jadwal->kelas_id)->where('mapel_kode',$jadwal->mapel_kode)->where('tahun_id',$jadwal->tahun_id)->first();

            if ($jadwal->guru_id == NULL) {
               
            }elseif($jadwal->guru_id != $pembagian ) {
                $pembagian->guru_id = $request->guru;
                $pembagian->update();

            }else {
                
            }
            
            return redirect()->route('jadwal')->with('success', 'Berhasil update jadwal!');
    }

    public function pdf(Request $request){
        $cari = $request->kelas;
        $tahun = Tahun::orderBy('id','DESC')->first();
        $jadwal = Jadwal::where('kelas_id','LIKE',"%".$cari."%")->where('tahun_id',$tahun->id)->orderBy('jam')->get();
        $ja = Jadwal::where('kelas_id','LIKE',"%".$cari."%")->where('tahun_id',$tahun->id)->first();
        $wali = Wali::where('kelas_id',$cari)->first();
        $pdf = PDF::loadview('admin.jadwal.pdf',compact('jadwal','ja','tahun','wali','cari'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('jadwal.pdf');
    }

    public function hapus($id){
        $tahun = Tahun::orderBy('id','DESC')->first();
        $jadwal = Jadwal::findorfail($id);
        $pembagian = Pembagian::where('guru_id',$jadwal->guru_id)->where('mapel_kode',$jadwal->mapel_kode);
        $guru_id = Jadwal::where('mapel_kode',$jadwal->mapel_kode)->where('tahun_id',$tahun->id)->where('guru_id',$jadwal->guru_id)->where('kelas_id',$jadwal->kelas_id)->count('guru_id');
        if ($jadwal->guru_id == NULL) {
            $jadwal->delete();
            return redirect()->back()->with('success', 'Berhasil hapus jadwal!');
        }elseif ($pembagian == NULL) {
            $jadwal->delete();
            return redirect()->back()->with('success', 'Berhasil hapus jadwal!');
        } else {
            if ($guru_id == '1' ) {
                $pembagian->delete();
                $jadwal->delete();
                return redirect()->back()->with('success', 'Berhasil hapus jadwal!');
            } else {
                $jadwal->delete();
                return redirect()->back()->with('success', 'Berhasil hapus jadwal!');
            }
        }
    }

    public function hapusAll(Request $request){
        $tahun = $request->tahun;
        Jadwal::where('tahun_id',$tahun)->delete();
        Pembagian::where('tahun_id',$tahun)->delete();
        return redirect()->back()->with('success', 'Semua jadwal berhasil dihapus!');
    }

    public function gurujadwal(){
        $tahun = Tahun::orderBy('id','DESC')->first();
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $jadwal = Jadwal::where('guru_id',$guru->id)->where('tahun_id',$tahun->id)->paginate(10);

        return view('guru.jadwal.index',compact('guru','jadwal'));
    }

    public function gurucari(Request $request){
        $cari = $request->cari;
        $tahun = Tahun::orderBy('id','DESC')->first();
        $user = User::where('id', Auth::user()->id)->first();
        $guru = Guru::where('user_id',$user->id)->first();
        $jadwal = Jadwal::where('hari','LIKE',"%".$cari."%")->where('guru_id',$guru->id)->where('tahun_id',$tahun->id)->paginate(10);

        return view('guru.jadwal.index',compact('jadwal','cari'));
    }

}
