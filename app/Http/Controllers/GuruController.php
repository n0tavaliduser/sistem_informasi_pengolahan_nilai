<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guru\StoreGuruRequest;
use App\Http\Requests\Guru\UpdateGuruRequest;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semua_guru = Guru::query()
            ->where(function ($query) use ($request) {
                $query->where('nama_lengkap', 'LIKE', '%' . $request->get('find') . '%')
                    ->orWhere('jenis_kelamin', 'LIKE', '%' . $request->get('find') . '%')
                    ->orWhere('tanggal_lahir', 'LIKE', '%' . $request->get('find') . '%')
                    ->orWhere('alamat', 'LIKE', '%' . $request->get('find') . '%');
            })
            ->where('jurusan_id', $request->get('jurusan_id'))
            ->orderBy('nama_lengkap', 'ASC')
            ->paginate(7);

        return view('pages.master-data.guru.index', [
            'semua_guru' => $semua_guru
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semua_jurusan = Jurusan::all();
        $users = User::where('role_id', Role::where('name', 'Guru')->get()->first()->id)
            ->with(['gurus'])
            ->whereDoesntHave('gurus')
            ->get();

        return view('pages.master-data.guru.create', [
            'semua_jurusan' => $semua_jurusan,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruRequest $request)
    {
        $password = strtolower(explode(' ', $request->get('nama_lengkap'))[0]) . '-guru';

        $userValidation = $request->validate(([
            'email' => 'required|unique:users,email,except,id'
        ]));

        $user = User::create([
            'name' => $request->get('nama_lengkap'),
            'email' => $userValidation['email'],
            'role_id' => Role::where('name', 'Guru')->first()->id,
            'password' => Hash::make($password)
        ]);

        $data = $request->validated();

        $guru = Guru::make($data);
        $guru->user_id = $user->id;
        $guru->saveOrFail();

        return redirect()->route('master-data.guru.index')->with(['success' => 'Berhasil menambahkan guru baru!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return view('pages.master-data.guru.show', [
            'guru' => $guru
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        $semua_jurusan = Jurusan::all();
        $users = User::where('role_id', Role::where('name', 'Guru')->get()->first()->id)->get();
            
        return view('pages.master-data.guru.update', [
            'guru' => $guru,
            'semua_jurusan' => $semua_jurusan,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        $data = $request->validated();

        $guru->fill($data);
        $guru->saveOrFail();

        return redirect()->route('master-data.guru.index')->with(['success' => 'Berhasil mengupdate data guru!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('master-data.guru.index')->with(['success' => 'Berhasil menghapus data guru!']);
    }

    public function resetPassword(Guru $guru)
    {   
        $user = User::where('id', $guru->user_id)->first();

        $user->update([
            'password' => Hash::make('guru12345')
        ]);

        return redirect()->back()->with(['success' => 'Berhasil reset password guru!']);
    }
}
