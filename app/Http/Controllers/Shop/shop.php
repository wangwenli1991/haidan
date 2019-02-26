<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class shop extends Controller
{
    public function index(){
        return view('Shop.shop');
    }
}
