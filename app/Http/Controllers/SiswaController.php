<?php

namespace App\Http\Controllers;

use App\Http\Requests\Siswa\StoreSiswaRequest;
use App\Http\Requests\Siswa\UpdateSiswaRequest;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semua_siswa = Siswa::where('kelas_id', $request->get('kelas_id'))
            ->where('nama_lengkap', 'LIKE', '%' . $request->get('find') . '%')
            ->orderBy('nama_lengkap', 'ASC')
            ->paginate(10);

        return view('pages.master-data.siswa.index', [
            'semua_siswa' => $semua_siswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master-data.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {
        $password = explode(' ', $request->get('nama_lengkap'))[0] . 'smkn1maros';

        $userValidation = $request->validate([
            'email' => 'required|unique:users,email,except,id'
        ]);

        $user = User::create([
            'name' => $request->get('nama_lengkap'),
            'email' => $userValidation['email'],
            'role_id' => $request->get('role_id'),
            'password' => Hash::make($password),
        ]);

        $data = $request->validated();

        $siswa = Siswa::make($data);
        $siswa->tahun_ajaran_id = TahunAjaran::where('status', 'active')->first()->id;
        $siswa->user_id = $user->id;
        $siswa->status = 'active';
        $siswa->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil menambahkan siswa baru!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
     
        return view('pages.master-data.siswa.update', [
            'siswa' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $data = $request->validated();

        $additionalData = $request->validate([
            'nomor_induk' => 'required|unique:siswa,nomor_induk,' . $siswa->id,
        ]);

        $siswa->fill($data);
        $siswa->nomor_induk = $additionalData['nomor_induk'];
        $siswa->saveOrFail();

        return redirect()->with(['success' => 'Berhasil update data siswa!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $user = User::with('siswas')
            ->whereHas('siswas', function ($query) use ($siswa) {
                $query->where('id', $siswa->id);
            })
            ->first();

        if ($user->avatar) {
            $oldFilePath = storage_path('app/public/' . $user->avatar);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $user->delete();
        $siswa->delete();

        return redirect()->route('master-data.siswa.index')->with(['success' => 'Berhasil menghapus data siswa']);
    }
}
