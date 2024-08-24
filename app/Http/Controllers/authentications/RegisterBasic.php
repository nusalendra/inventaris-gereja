<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function store(Request $request)
  {
    try {
      $request->validate([
        'name' => 'required|string',
        'username' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|max:8',
        'nomor_telephone' => 'required'
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return back()->with('error', 'Password tidak boleh lebih dari 8 karakter!');
    }

    $user = new User();
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->nomor_telephone = $request->nomor_telephone;
    $user->role = 'Peminjam';
    $user->save();

    return redirect('/');
  }
}
