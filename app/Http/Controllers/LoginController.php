<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;

class LoginController extends Controller
{
    public function  login(){
        
        return view('login');
    }
    
    public function doLogin(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => "required|min:5|max:10",
        ]);

        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator)->withInput();
        }
        
        $inputs = $request->all();
        $credentials = ['email' => $inputs['email'], 'password' => $inputs['password']];
        
        if(auth()->attempt($credentials))
        { 
            return redirect('/players');
            
        }else{
            
            return redirect()->route('login')->with('error','Email-Address And Password Are Wrong.');
        }
    }
    
    public function  chart(){
        
        return view('chart');
    }
    
    public function logout(){
        
        if(auth()->user()){
            auth()->logout();
        }
        Session::flush();
        return \redirect('/login');
    }
}
