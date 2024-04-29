<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function store()
    {
        $attributes = request()->validate([
            'username'=>'required',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            if(Auth::user()->role == "Kepala Sekolah") {
                return redirect('dashboard-kepala-sekolah')->with(['success'=>'Kamu sudah login']);
            } else if(Auth::user()->role == "Wali Kelas") {
                return redirect('dashboard-wali-kelas')->with(['success'=>'Kamu sudah login']);
            } else if(Auth::user()->role == "Guru Penjaskes") {
                return redirect('#')->with(['success'=>'Kamu sudah login']);
            } else if(Auth::user()->role == "Guru Agama") {
                return redirect('#')->with(['success'=>'Kamu sudah login']);
            }
        }
        else{
            return back()->withErrors(['username'=>'Nama user atau password anda salah...']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login');
    }
}
