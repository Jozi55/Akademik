<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControllers extends Controller
{
    public function admin_index(){

        return view('admin.home.index');
    }

    public function guru_index(){
        return view('guru.home.index');
    }
}
