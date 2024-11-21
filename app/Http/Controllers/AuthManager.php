<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthManager extends Controller
{
    function login(){
        return view('login');
    }

    function register(){
        return view('register');
    }
    
    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route(name:'home'));
        return redirect(route(name:'login'))->with('error',"Login detaols are not correct");

    }

    function registerPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required'
        ]);
       
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if(!$user){
            return redirect(route(name:'register'))->with('error',"Something went wrong");
        }
        return redirect(route(name:'login'))->with('success',"User created successfully");
    }
    function logout(){
        Auth::logout();
        return redirect(route(name:'login'));
}
}
}
