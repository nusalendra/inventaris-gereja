<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function store(Request $request)
  {
    $attributes = request()->validate([
      'name' => ['required', 'max:50'],
      'username' => ['required', 'max:50'],
      'password' => ['required'],
      'nomor_telephone' => ['required'],
    ]);

    $attributes['password'] = bcrypt($attributes['password']);
    $attributes['role'] = 'Peminjam';

    session()->flash('success', 'Your account has been created.');
    User::create($attributes);

    return redirect('/');
  }
}
