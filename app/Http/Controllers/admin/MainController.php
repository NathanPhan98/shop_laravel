<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('admin.home',[
            'title' => "Admin page ne"
        ]);
    }

    public function products(){
        return view('admin.product',[
            'title' => "san pham ban oi"
        ]);
    }
}
