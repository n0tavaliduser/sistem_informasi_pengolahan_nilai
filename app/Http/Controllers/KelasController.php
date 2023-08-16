<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kelas\StoreKelasRequest;
use App\Http\Requests\Kelas\UpdateKelasRequest;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semua_kelas = Kelas::query()
            ->where(function ($query) use ($request) { 
                $query->where('nama_kelas', 'LIKE', '%' , $request->get('find') , '%');
            })
            ->paginate(10);
        
        return view('pages.master-data.kelas.index', [
            'semua_kelas' => $semua_kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semua_guru = Guru::all();
        $semua_jurusan = Jurusan::all();
        $semua_tahun_ajaran = TahunAjaran::where('status', 'active')->get();

        return view('pages.master-data.kelas.create', [
            'semua_guru' => $semua_guru,
            'semua_jurusan' => $semua_jurusan,
            'semua_tahun_ajaran' => $semua_tahun_ajaran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request)
    {
        $data = $request->validated();

        $kelas = Kelas::make($data);
        $kelas->saveOrFail();

        return redirect()->route('master-data.kelas.index')->with(['success' => 'Berhasil menambahkan kelas baru!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        $semua_guru = Guru::all();
        $semua_jurusan = Jurusan::all();
        $semua_tahun_ajaran = TahunAjaran::where('status', 'active')->get();

        return view('pages.master-data.kelas.update', [
            'kelas' => $kelas,
            'semua_guru' => $semua_guru,
            'semua_jurusan' => $semua_jurusan,
            'semua_tahun_ajaran' => $semua_tahun_ajaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        $data = $request->validated();

        $kelas->fill($data);
        $kelas->saveOrFail();

        return redirect()->route('master-data.kelas.index')->with(['success' => 'Berhasil update data kelas!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('master-data.kelas.index')->with(['success' => 'Berhasil menghapus data kelas!']);
    }
}
