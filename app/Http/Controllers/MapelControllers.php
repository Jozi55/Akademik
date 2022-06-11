<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelControllers extends Controller
{
    public function index(){
        $mapel = Mapel::orderBY('kode','ASC')->paginate(10);
        return view('admin.mapel.index',compact('mapel'));
    }

    public function cari(Request $request){
        $kelompok = $request->kelompok;
        $mapel = Mapel::orderBY('kode','ASC')->paginate(10);
        if ( $kelompok) {
            $mapel = Mapel::where('kelompok','LIKE',"%".$kelompok."%")
            ->orderBY('kode','ASC')->paginate(10);
            $mapel->appends(['kelompok'=>$kelompok]);
            return view('admin.mapel.index',compact('mapel'));
        } else {
            return view('admin.mapel.index',compact('mapel'));
        }
        
    }

    public function simpan(Request $request){
        $validate = Validator::make($request->all(),[
            'kode' => 'unique:mapels,kode',
            'mapel' => 'unique:mapels,mapel',
            'nama' => 'unique:mapels,nama',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Kode atau Mapel yang di input sudah ada!');
        }else{
                foreach ($request->mapel as $key => $value) {
                    $mapel = new Mapel();
                    $mapel->kode = strtoupper($request->kode[$key]);
                    $mapel->nama = strtoupper($request->nama[$key]);
                    $mapel->mapel = ucwords($value);
                    $mapel->kelompok = ucwords($request->kelompok[$key]);
                    $mapel->save();
                }
                return redirect()->back()->with('success', 'Berhasil menambahkan data mapel!');
            }
        }

    public function update(Request $request,$kode){
        
        $mapel = Mapel::where('kode',$kode)->first();
        $mapel->kode = strtoupper($request->kode);
        $mapel->nama = strtoupper($request->nama);
        $mapel->mapel = ucwords($request->mapel);
        $mapel->kelompok = ucwords($request->kelompok);
        $mapel->update();  
    
        return redirect()->back()->with('success', 'Berhasil mengupdate data mapel!');
    }
        
}
