<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tugas\StoreTugasRequest;
use App\Http\Requests\Tugas\UpdateTugasRequest;
use App\Models\JadwalPelajaran;
use App\Models\Tugas;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTugasRequest $request, JadwalPelajaran $jadwal)
    {
        $data = $request->validated();

        $tugas = Tugas::make($data);
        $tugas->status = 'open';
        $tugas->mata_pelajaran_id = $jadwal->mata_pelajaran->id;
        $tugas->guru_id = $jadwal->guru->id;
        $tugas->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil menambahkan tugas baru!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tugas $tugas)
    {
        return view('pages.kelas.tugas_detail', [
            'tugas' => $tugas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPelajaran $jadwal, Tugas $tugas)
    {
        return view('pages.kelas.update_tugas', [
            'tugas' => $tugas,
            'jadwal' => $jadwal
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTugasRequest $request, Tugas $tugas)
    {
        $data = $request->validated();

        $tugas->fill($data);
        $tugas->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil update data tugas!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas $tugas)
    {
        $tugas->delete();

        return redirect()->back()->with(['success' => 'Berhasil menghapus tugas!']);
    }

    public function tutupTugas(Tugas $tugas)
    {
        $tugas->update([
            'status' => 'closed',
        ]);
        $tugas->saveOrFail();

        return redirect()->back()->with(['success' => 'Tugas berhasil ditutup!']);
    }

    public function bukaTugas(Tugas $tugas)
    {
        $tugas->update([
            'status' => 'open',
        ]);

        return redirect()->back()->with(['success' => 'Tugas berhasil dibuka!']);
    }
}
