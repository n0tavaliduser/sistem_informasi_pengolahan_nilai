<?php

namespace App\Http\Controllers;

use App\Http\Requests\NilaiMataPelajaran\StoreNilaiMataPelajaranRequest;
use App\Http\Requests\NilaiMataPelajaran\UpdateNilaiMataPelajaranRequest;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\NilaiMataPelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiMataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semua_nilai_mata_pelajaran = NilaiMataPelajaran::with('mata_pelajaran')
            ->whereHas('mata_pelajaran.jadwal_pelajarans.guru', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('mata_pelajaran_id', $request->get('mata_pelajaran_id'))
            ->get();

        $semua_mata_pelajaran = MataPelajaran::with(['jadwal_pelajarans'])
            ->whereHas('jadwal_pelajarans.kelas', function ($query) use ($request) {
                $query->where('id', $request->get('kelas_id'));
            })
            ->get();

        $semua_kelas = Kelas::with(['jadwal_pelajarans'])
            ->whereHas('jadwal_pelajarans.guru', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->get();

        $semua_siswa = Siswa::where('kelas_id', $request->get('kelas_id'))->get();

        return view('pages.nilai-mata-pelajaran.index', [
            'semua_nilai_mata_pelajaran' => $semua_nilai_mata_pelajaran,
            'semua_mata_pelajaran' => $semua_mata_pelajaran,
            'semua_kelas' => $semua_kelas,
            'semua_siswa' => $semua_siswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNilaiMataPelajaranRequest $request)
    {
        $data = $request->validated();

        $nilai_mata_pelajaran = NilaiMataPelajaran::make($data);
        $nilai_mata_pelajaran->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil menambahkan nilai mata pelajaran!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(NilaiMataPelajaran $nilai_mata_pelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NilaiMataPelajaran $nilai_mata_pelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNilaiMataPelajaranRequest $request, NilaiMataPelajaran $nilai_mata_pelajaran)
    {
        $data = $request->validated();

        $nilai_mata_pelajaran->fill($data);
        $nilai_mata_pelajaran->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil update nilai mata pelajaran!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiMataPelajaran $nilai_mata_pelajaran)
    {
        $nilai_mata_pelajaran->delete();

        return redirect()->back()->with(['success' => 'Berhasil menghapus nilai mata pelajaran!']);
    }
}
