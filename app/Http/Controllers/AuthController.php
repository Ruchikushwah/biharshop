<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    public function login(Request $req){
        if($req->isMethod("post")){
            $req->validate([
                'email'=>'required|email',
                'password'=>'required|min:8'
            ]);
            $credentials = $req->only('email','password');
            if(FacadesAuth::attempt($credentials)){
                return redirect()->route('homepage')->with('success','login successfully');
            }
            return back()->withErrors(['email'=> 'invailid creadentials']);
        }

        return view('login');
    }
    public function register(Request $req){

        if($req->isMethod("post")){
            $req->validate([
                
                'name' => 'required|max:255',
                'email'=> 'required|email|unique:users',
                'password'=> 'required|min:8',
                'contact'=>'required'
            ]);

            $user = new User();
            $user->name= $req->name;
            $user->email=$req->email;
            $user->password=$req->password;
            $user->contact=$req->contact;
            $user->save();
            return redirect()->route('login')->with('success','registration successfully');

        }
        return view('register');
    }
    public function logout(){
        FacadesAuth::logout();
        return redirect()->route('login')->with('success','logout successfully');
    }
    
}
