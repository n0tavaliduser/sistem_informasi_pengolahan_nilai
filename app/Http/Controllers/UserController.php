<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangePhotoProfileRequest;
use App\Http\Requests\User\UpdateGuruProfileRequest;
use App\Http\Requests\User\UpdateSiswaProfileRequest;
use App\Models\Guru;
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

    public function editSiswaProfile()
    {
        if (Auth::user()->role->name == 'Siswa') {
            return view('pages.user.edit-siswa-profile',[ 
                'siswa' => Siswa::where('user_id', Auth::user()->id)->first(),
            ]);
        }
    }

    public function editGuruProfile()
    {
        if (Auth::user()->role->name == 'Guru') {
            return view('pages.user.edit-guru-profile',[ 
                'guru' => Guru::where('user_id', Auth::user()->id)->first(),
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

    public function updateSiswaProfile(UpdateSiswaProfileRequest $request, Siswa $siswa)
    {
        $data = $request->validated();

        User::where('id', $siswa->user_id)->update([
            'name' => $siswa->nama_lengkap
        ]);

        $siswa->fill($data);
        $siswa->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil update profile!']);
    }

    public function updateGuruProfile(UpdateGuruProfileRequest $request, Guru $guru)
    {
        $data = $request->validated();

        User::where('id', $guru->user_id)->update([
            'name' => $guru->nama_lengkap
        ]);

        $guru->fill($data);
        $guru->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil update profile!']);
    }
}
