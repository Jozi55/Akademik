<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminControllers extends Controller
{
    public function index(){
        $user = User::where('role','admin')->get();

        return view('admin.profile.index',compact('user'));
    }

    public function password(Request $request,$id){
        $user = User::findorfail($id);
        $user->password = bcrypt($request->password);
        $user->update();
        return redirect()->route('logout')->with('success', 'Berhasil update password');

    }

    public function email(Request $request,$id){
        $user = User::findorfail($id);
        $user->email = $request->email;
        $user->update();
        return redirect()->route('logout')->with('success', 'Berhasil update email');

    }
}
