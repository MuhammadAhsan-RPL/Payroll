<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(){
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return redirect('/admin')->with('success','berhasil login sebagai admin');
            }else if(Auth::user()->role == 'user'){
                return redirect('/Attendance')->with('success','berhasil login sebagai user');
            }
        }
        return view('auth.login')->with('message','anda harus login terlebih dahulu');
    }

    public function actionLogin(Request $request){
        $credential = $request->validate([
            'email' => 'required|email',
            'password'=> 'required',
        ]);

        // 🔥 TAMBAHAN: Cek apakah email terdaftar (TIDAK MERUSAK YANG LAIN)
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak terdaftar di sistem kami.');
        }

        if(Auth::attempt($credential)){
            if(Auth::user()->role == 'admin'){
                return redirect('/admin')->with('success','berhasil login sebagai admin');
            }else if(Auth::user()->role == 'user'){
                return redirect('/Attendance')->with('success','berhasil login sebagai user');
            }
        }else{
            return redirect()->back()->with('error','Password yang Anda masukkan salah.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success','berhasil logout');
    }
}