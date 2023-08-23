<?php

namespace App\Http\Controllers;

use App\Http\Requests\Materi\StoreMateriRequest;
use App\Http\Requests\Materi\UpdateMateriRequest;
use App\Models\JadwalPelajaran;
use App\Models\MataPelajaran;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role->name == 'Guru') {
            $semua_materi = Materi::with('jadwal_pelajaran')
                ->whereHas('jadwal_pelajaran.guru', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->whereHas('jadwal_pelajaran', function ($query) use ($request) {
                    $query->where('kelas_id', $request->get('kelas_id'));
                })
                ->paginate(10);
            $semua_jadwal_pelajaran = JadwalPelajaran::with('guru')
                ->whereHas('guru', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->get();
            $semua_mata_pelajaran = MataPelajaran::with('jadwal_pelajarans')
                ->whereHas('jadwal_pelajarans.guru', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->get();
        } elseif (Auth::user()->role->name == 'Siswa') {
            $semua_materi = Materi::with('jadwal_pelajaran')
                ->whereHas('jadwal_pelajaran.kelas.siswas', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->whereHas('jadwal_pelajaran', function ($query) use ($request) {
                    $query->where('mata_pelajaran_id', $request->get('mata_pelajaran_id'));
                })
                ->paginate(10);
            $semua_jadwal_pelajaran = JadwalPelajaran::with('guru')
                ->whereHas('guru', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->get();
            $semua_mata_pelajaran = MataPelajaran::with('jadwal_pelajarans')
                ->whereHas('jadwal_pelajarans.kelas.siswas', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->get();
        }

        return view('pages.materi.index', [
            'semua_materi' => $semua_materi,
            'semua_jadwal_pelajaran' => $semua_jadwal_pelajaran,
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
    public function store(StoreMateriRequest $request)
    {
        $data = $request->validated();

        $file = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store(Materi::FILE_PATH, 'public');
        }

        $materi = Materi::make($data);
        $materi->file = $file;
        $materi->saveOrFail();

        return redirect()->route('materi.index')->with(['success' => 'Berhasil menambahkan materi baru!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMateriRequest $request, Materi $materi)
    {
        $data = $request->validated();

        $file = $materi->file;
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store(Materi::FILE_PATH, 'public');
            if ($materi->file) {
                $oldFilePath = storage_path('app/public/' . $materi->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        $materi->fill($data);
        $materi->file = $file;
        $materi->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil update data materi!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi)
    {
        if ($materi->file) {
            $oldFilePath = storage_path('app/public/' . $materi->file);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $materi->delete();

        return redirect()->route('materi.index')->with(['success' => 'Berhasil menghapus data materi!']);
    }

    public function downloadFile(Materi $materi)
    {
        return response()->download('storage/' . $materi->file);
    }
}
