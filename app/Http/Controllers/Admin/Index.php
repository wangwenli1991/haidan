<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Index extends Controller
{
    //
    public function index(){
        return view('Admin.index'); //这里出过错，要记得有return
    }
    public function welcome(){
        return view('Admin.welcome');
    }
}
