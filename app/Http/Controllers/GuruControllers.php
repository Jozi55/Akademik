<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pembagian;
use App\Models\User;
use App\Models\Wali;
use App\Notifications\informasi;
use App\Notifications\password;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;


class GuruControllers extends Controller
{
    public function index(){
        $guru = Guru::where('status','Aktif')->get();
        return view('admin.guru.index',compact('guru'));
    }

    public function cari(Request $request){
        $status = $request->status;
        $guru = Guru::where('status',$status)->get();

        return view('admin.guru.index',compact('guru'));
    }

    public function simpan(Request $request){
        $validate = Validator::make($request->all(),[
            'email' => 'unique:users,email',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Email yang di input sudah ada!');
        }else{
            $user = new User();
            $user->nama = ucwords($request->nama);
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'guru';
            $user->status = 'Aktif';
            $user->save();

            $guru = new Guru();
            $guru->nip = $request->nip;
            $guru->nama = ucwords($request->nama);
            $guru->user_id = $user->id;
            $guru->status = 'Aktif';
            $guru->save();

            $data = [
                'pembuka' => 'Akun Berhasil Dibuat',
                'action' => 'Login',
                'hasil' => "email : $request->email
                            password : $request->password "
    
            ];
            $user->notify(new informasi($data));

        }
            return redirect()->back()->with('success', 'Berhasil menambahkan data guru!');
    }

    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'email' =>'unique:users,email,' .$request->user_id,
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Email yang di input sudah ada!');
        }else{
            $user_id = $request->user_id;
            $guru = Guru::findorfail($id);
            $guru->nama = ucwords($request->nama);
            $guru->nip = $request->nip;
            $guru->status = $request->status;
            $guru->update();

            $user = User::findorfail($user_id);
            $user->nama = ucwords($request->nama);
            $user->email = $request->email;
            $user->status = $request->status;
            $user->update();
            return redirect()->back()->with('success', 'Berhasil mengupdate data guru!');
        }
    }
    public function password(Request $request){
        $guru = User::findorfail($request->user_id);
        $guru->password = bcrypt($request->password);
        $guru->update();

        $data = [
            'pembuka' => 'Password berhasil di ubah',
            'action' => 'Login',
            'hasil' => "password :$request->password "
        ];
        $guru->notify(new password($data));
        return redirect()->back()->with('success', 'Berhasil mengupdate password guru!');
    }

}
