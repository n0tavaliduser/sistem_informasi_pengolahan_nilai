<?php

namespace App\Http\Controllers;

use App\Http\Requests\Absensi\StoreAbsensiRequest;
use App\Models\Absensi;
use App\Models\JadwalPelajaran;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
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
    public function store(StoreAbsensiRequest $request, Siswa $siswa, JadwalPelajaran $jadwal)
    {
        $data = $request->validated();

        $absensi = Absensi::make($data);
        $absensi->siswa_id = $siswa->id;
        $absensi->semester = $jadwal->semester;
        $absensi->tahun_ajaran_id = $jadwal->tahun_ajaran_id;
        $absensi->tanggal = Carbon::now();
        $absensi->kelas_id = $jadwal->kelas_id;
        $absensi->mata_pelajaran_id = $jadwal->mata_pelajaran_id;
        $absensi->saveOrFail();

        return redirect()->back()->with(['success' => 'Data absensi berhasil dibuat!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
