<?php

namespace App\Http\Controllers;

use App\Models\Kepala;
use App\Models\Kepsek;
use Illuminate\Http\Request;

class KepsekControllers extends Controller
{
    public function index(){
        $kepsek =  Kepala::where('status','Menjabat')->get();
        return view('admin.kepala.index',compact('kepsek'));
    }

    public function simpan(Request $request){
        $kepsek = new Kepala();
        $kepsek->nip = $request->nip;
        $kepsek->nama = ucwords($request->nama); 
        $kepala = Kepala::where('status','Menjabat')->first();
        $kepala->status = "Tidak Menjabat";
        $kepala->update();
        $kepsek->save();
        return redirect()->back()->with('success', 'Berhasil menyimpan data kepala sekolah!');
        
    }

    public function cari(Request $request){
        $status = $request->status;

        $kepsek = Kepala::where('status',$status)->get();
        return view('admin.kepala.index',compact('kepsek'));
    }

    public function edit(Request $request,$id){
        $kepsek = Kepala::findorfail($id);
        $kepsek->nip = $request->nip;
        $kepsek->nama = ucwords($request->nama);
        $kepsek->status = $kepsek->status;
        $kepsek->update();
        return redirect()->back()->with('success', 'Berhasil update data kepala sekolah!');
       
    }

}
