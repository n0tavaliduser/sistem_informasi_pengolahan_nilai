<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('pages.user.profile');
    }

    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        $data = $request->validated();

        if (Hash::check($data['current_password'], $user->password)) {
            $user->password = Hash::make($data['new_password']);
            $user->saveOrFail();

            return redirect()->back()->with(['success' => 'Berhasil mengganti password!']);
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Password sebelumnya yang anda masukan salah!']);
        }
    }
}
