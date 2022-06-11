<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;

class TahunControllers extends Controller
{
    public function index(){
        $tahun = Tahun::orderBy('id','DESC')->get();
        return view('admin.tahun.index',compact('tahun'));
    }

    public function simpan(Request $request){
        $tahun = new Tahun();
        $tahun->tahun = $request->tahun;
        $tahun->semester = $request->semester;
        $tahun->save();
        return redirect()->back()->with('success', 'Berhasil menambahkan data tahun ajaran!');
    }

    public function update(Request $request,$id){
        $tahun=Tahun::findorfail($id);
        $tahun->tahun = $request->tahun;
        $tahun->semester = $request->semester;
        $tahun->update();
        return redirect()->back()->with('success', 'Berhasil mengubah data tahun ajaran!');
    }

}
