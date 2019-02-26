<?php

namespace App\Http\Controllers\Meet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class meet extends Controller
{
    public function index(){
        return view('Meet.meet');
    }
}