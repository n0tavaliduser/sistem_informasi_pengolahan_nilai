<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengumpulanTugas\StorePengumpulanTugasRequest;
use App\Http\Requests\PengumpulanTugas\UpdatePengumpulanTugasRequest;
use App\Http\Requests\PengumpulanTugas\UpdateNilaiTugasRequest;
use App\Models\PengumpulanTugas;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumpulanTugasController extends Controller
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
    public function store(StorePengumpulanTugasRequest $request, Tugas $tugas)
    {
        $data = $request->validated();

        $file = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store(PengumpulanTugas::FILE_PATH, 'public');
        }

        $siswa = Siswa::where('user_id', Auth::user()->id)->first();

        $pengumpulan_tugas = PengumpulanTugas::make($data);
        $pengumpulan_tugas->tugas_id = $tugas->id;
        $pengumpulan_tugas->mata_pelajaran_id = $tugas->mata_pelajaran_id;
        $pengumpulan_tugas->siswa_id = $siswa->id;
        $pengumpulan_tugas->kelas_id = $siswa->kelas->id;
        $pengumpulan_tugas->file = $file;
        $pengumpulan_tugas->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil mengumpulkan data tugas!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(PengumpulanTugas $pengumpulan_tugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengumpulanTugas $pengumpulan_tugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengumpulanTugasRequest $request, PengumpulanTugas $pengumpulan_tugas)
    {
        $data = $request->validated();

        // dd($pengumpulan_tugas);
        
        $file = $pengumpulan_tugas->file;
        if ($request->hasFile('file')) {
            $file = $request->file('file')->store(PengumpulanTugas::FILE_PATH, 'public');
            if ($pengumpulan_tugas->file) {
                $oldFilePath = storage_path('app/public/' . $pengumpulan_tugas->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        $pengumpulan_tugas->fill($data);
        $pengumpulan_tugas->file = $file;
        $pengumpulan_tugas->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil update data tugas!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengumpulanTugas $pengumpulan_tugas)
    {
        if ($pengumpulan_tugas->file) {
            $oldFilePath = storage_path('app/public/' . $pengumpulan_tugas->file);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $pengumpulan_tugas->delete();

        return redirect()->back()->with(['success' => 'Berhasil menghapus data tugas!']);
    }

    public function downloadFile(PengumpulanTugas $pengumpulan_tugas)
    {
        return response()->download('storage/' . $pengumpulan_tugas->file);
    }

    public function nilaiPengumpulanTugas(UpdateNilaiTugasRequest $request, PengumpulanTugas $pengumpulan_tugas)
    {
        $data = $request->validated();

        $pengumpulan_tugas->fill($data);
        $pengumpulan_tugas->saveOrFail();

        return redirect()->back()->with(['success' => 'Berhasil memberikan nilai tugas!']); 
    }
}
