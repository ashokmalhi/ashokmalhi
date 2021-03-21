<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Models\PasswordReset;


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

    public function passwordReset(Request $request){
        $this->validate($request, [
			'email'	=> 'required',
			'token'		=> 'required',
		]);
        $password_reset = PasswordReset::where('email', $request->email)->where('token',$request->token)->first();
        if($password_reset){
            return view('reset_password', compact('password_reset'));
        }else{
            return view('login');
        }
    }

    public function updatePassword(Request $request){
        // Validating Inputs
		$rules = [
			'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
		];
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			$messages = $validator->messages();
			return Redirect::back()->withErrors($validator)->withInput();
		} else {
            $updatePassword = User::updatePassword($request->all());
            if($updatePassword){
                return redirect()->route('login')->with('success','Password updated successfully');
            }
            else{
                return redirect()->route('login')->with('error','Email not found');
            }
        }
    }
}
