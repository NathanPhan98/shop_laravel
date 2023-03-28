<?php

namespace App\Http\Controllers\admin\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logincontroller extends Controller
{
    public function index(){
        return view('admin.users.login', [
            'title' => 'LOGIN'
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->input());
        $this->validate($request,[
            'email' =>'required|email:filter',
            'password' => 'required'
        ]);
        
        if(Auth::attempt(
            [
                'email' => $request->input('email') ,
                'password' => $request->input('password') 
            ],$request->input('remember'))){
                return redirect()->route('admin');
            }
        
            session()->flash('error','Email and password are ircorrect!!!!!');
            
            return redirect()->back();
    }


}
