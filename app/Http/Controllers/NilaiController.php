<?php

namespace App\Http\Controllers;

use App\Http\Requests\Nilai\StoreNilaiRequest;
use App\Http\Requests\Nilai\UpdateNilaiRequest;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semua_nilai = Nilai::with('siswa')
            ->whereHas('siswa', function ($query) use ($request) {
                $query->where('kelas_id', $request->get('kelas_id'));
            })
            ->where('siswa_id', $request->get('siswa_id'))
            ->get();
        $semua_mata_pelajaran = MataPelajaran::with('jadwal_pelajarans')
            ->whereHas('jadwal_pelajarans', function ($query) use ($request) {
                $query->where('kelas_id', $request->get('kelas_id'));
            })
            ->get();

        return view('pages.nilai.index', [
            'semua_nilai' => $semua_nilai,
            'semua_mata_pelajaran' => $semua_mata_pelajaran
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
    public function store(StoreNilaiRequest $request)
    {
        $data = $request->validated();

        $nilai = Nilai::make($data);
        $nilai->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil menambahkan data nilai!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNilaiRequest $request, Nilai $nilai)
    {
        $data = $request->validated();

        $nilai->fill($data);
        $nilai->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil update data nilai!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->back()->with(['success' => 'Berhasil menghapus data nilai!']);
    }
}