<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordBasic extends Controller
{
    public function index()
    {
        return view('content.authentications.auth-change-password-basic');
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'password_lama' => 'required',
                'password_baru' => 'required|max:8',
                'konfirmasi_password_baru' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Password baru tidak boleh lebih dari 8 karakter!');
        }

        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return back()->with('error', 'Password lama tidak sesuai!');
        }

        if ($request->konfirmasi_password_baru !== $request->password_baru) {
            return back()->with('error', 'Konfirmasi password baru tidak sesuai dengan password baru!');
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password_baru);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
