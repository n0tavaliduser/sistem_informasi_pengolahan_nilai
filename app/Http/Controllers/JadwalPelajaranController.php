<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalPelajaran\StoreJadwalPelajaranRequest;
use App\Http\Requests\JadwalPelajaran\UpdateJadwalPelajaranRequest;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semua_kelas = Kelas::all();
        $semua_tahun_ajaran = TahunAjaran::where('status', 'active')->get();
        $semua_guru = Guru::all();
        $semua_mata_pelajaran = MataPelajaran::all();

        if (Auth::user()->role->name == 'Admin') {
            $semua_jadwal = JadwalPelajaran::query()
                ->orderBy('jam_mulai', 'ASC')
                ->paginate(100);
        } elseif (Auth::user()->role->name == 'Siswa') {
            $semua_jadwal = JadwalPelajaran::with('kelas')
                ->whereHas('kelas.siswas', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->get();
        } elseif (Auth::user()->role->name == 'Guru') {
            $semua_jadwal = JadwalPelajaran::with('guru')
                ->whereHas('guru', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->get();
        }

        return view('pages.jadwal-pelajaran.index', [
            'semua_jadwal' => $semua_jadwal,
            'semua_kelas' => $semua_kelas,
            'semua_tahun_ajaran' => $semua_tahun_ajaran,
            'semua_guru' => $semua_guru,
            'semua_mata_pelajaran' => $semua_mata_pelajaran,
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
    public function store(StoreJadwalPelajaranRequest $request)
    {
        $data = $request->validated();

        $jadwal_pelajaran = JadwalPelajaran::make($data);
        $jadwal_pelajaran->saveOrFail();

        return redirect()->route('jadwal-pelajaran.index')->with(['success' => 'Berhasil menambahkan mata pelajaran baru!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalPelajaran $jadwal_pelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPelajaran $jadwal_pelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalPelajaranRequest $request, JadwalPelajaran $jadwal_pelajaran)
    {
        $data = $request->validated();

        $jadwal_pelajaran->fill($data);
        $jadwal_pelajaran->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil update jadwal pelajaran']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPelajaran $jadwal_pelajaran)
    {
        //
    }
}
