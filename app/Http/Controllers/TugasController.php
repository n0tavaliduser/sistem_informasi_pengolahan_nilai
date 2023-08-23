<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tugas\StoreTugasRequest;
use App\Http\Requests\Tugas\UpdateTugasRequest;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\MataPelajaran;
use App\Models\PengumpulanTugas;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semua_tugas = null;
        if (Auth::user()->role->name == 'Siswa') {
            $semua_tugas = Tugas::with('kelas')
                ->whereHas('kelas.siswas', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->paginate(10);
        } elseif (Auth::user()->role->name == 'Guru') {
            $semua_tugas = Tugas::query()
                ->where(function ($query) use ($request) {
                    $query->where('judul', 'LIKE', '%' . $request->get('find') . '%');
                })
                ->where('kelas_id', $request->get('kelas_id'))
                ->where('guru_id', Guru::where('user_id', Auth::user()->id)->first()->id)->paginate(10);
        }

        return view('pages.tugas.index', [
            'semua_tugas' => $semua_tugas
        ]);
    }

    public function rekapNilai(Request $request)
    {
        $semua_pengumpulan_tugas = PengumpulanTugas::with('kelas')
            ->whereHas('kelas', function ($query) use ($request) {
                $query->where('id', $request->get('kelas_id'));
            })
            ->whereHas('mata_pelajaran.jadwal_pelajarans.guru', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('mata_pelajaran_id', $request->get('mata_pelajaran_id'))
            ->where('siswa_id', $request->get('siswa_id'))
            ->get();

        $semua_mata_pelajaran = MataPelajaran::with('jadwal_pelajarans')
            ->whereHas('jadwal_pelajarans.guru', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->get();

        $semua_siswa = Siswa::where('kelas_id', $request->get('kelas_id'))->get();

        return view('pages.tugas.penilaian', [
            'semua_pengumpulan_tugas' => $semua_pengumpulan_tugas,
            'semua_mata_pelajaran' => $semua_mata_pelajaran,
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
    public function store(StoreTugasRequest $request, JadwalPelajaran $jadwal)
    {
        $data = $request->validated();

        $file = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store(Tugas::FILE_PATH, 'public');
        }

        $tugas = Tugas::make($data);
        $tugas->status = 'open';
        $tugas->mata_pelajaran_id = $jadwal->mata_pelajaran->id;
        $tugas->file = $file;
        $tugas->guru_id = $jadwal->guru->id;
        $tugas->kelas_id = $jadwal->kelas_id;
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

        $file = $tugas->file;
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store(Tugas::FILE_PATH, 'public');
            if ($tugas->file) {
                $oldFilePath = storage_path('app/public/' . $tugas->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        $tugas->fill($data);
        $tugas->file = $file;
        $tugas->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil update data tugas!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas $tugas)
    {
        if ($tugas->file) {
            $oldFilePath = storage_path('app/public/' . $tugas->file);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        
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

    public function downloadFile(Tugas $tugas)
    {
        return response()->download('storage/' . $tugas->file);
    }
}
