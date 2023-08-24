<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangePhotoProfileRequest;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('pages.user.profile');
    }

    public function editProfile()
    {
        if (Auth::user()->role->name == 'Siswa') {
            return view('pages.user.edit-siswa-profile',[ 
                'siswa' => Siswa::where('user_id', Auth::user()->id)->first(),
            ]);
        }
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

    public function changeProfilePic(ChangePhotoProfileRequest $request, User $user)
    {
        $data = $request->validated();

        $avatar = $user->avatar;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store(User::AVATAR_PATH, 'public');
            if ($user->avatar) {
                $oldFilePath = storage_path('app/public/' . $user->avatar);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        $user->fill($data);
        $user->avatar = $avatar;
        $user->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil mengganti photo profile!']);
    }
}
