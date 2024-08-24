<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\KirimPasswordBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-forgot-password-basic');
  }

  public function resetPassword(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
    ]);

    if ($validator->fails()) {
      $errorMessage = $validator->errors()->first();

      return redirect()->back()->with('error', $errorMessage);
    }
    
    $user = User::where('email', $request->email)->first();
    
    if (!$user) {
      return redirect()->back()->with('error', 'Email tidak ditemukan');
    }

    $passwordBaru = rand(10000000, 99999999);
    $user->password = Hash::make($passwordBaru);
    $user->save();

    $dataUser = [
      'name' => $user->name,
      'email' => $user->email,
      'passwordBaru' => $passwordBaru
    ];

    $user->notify(new KirimPasswordBaru($dataUser));

    return redirect()->back()->with('success', 'Password baru telah dikirim ke email anda.');
  }
}
