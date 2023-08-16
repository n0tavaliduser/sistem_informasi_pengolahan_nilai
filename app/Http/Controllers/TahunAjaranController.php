<?php

namespace App\Http\Controllers;

use App\Http\Requests\TahunAjaran\StoreTahunAjaranRequest;
use App\Http\Requests\TahunAjaran\UpdateTahunAjaranRequest;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semua_tahun_ajaran = TahunAjaran::orderBy('tahun_berakhir', 'DESC')
            ->paginate(10);

        return view('pages.master-data.tahun-ajaran.index', [
            'semua_tahun_ajaran' => $semua_tahun_ajaran
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master-data.tahun-ajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTahunAjaranRequest $request)
    {
        $data = $request->validated();

        $tahun_ajaran = TahunAjaran::make($data);
        $tahun_ajaran->saveOrFail();

        return redirect()->route('master-data.tahun-ajaran.index')->with(['success' => 'Berhasil menambahkan tahun ajaran baru!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAjaran $tahun_ajaran)
    {
        return view('pages.master-data.tahun-ajaran.update', [
            'tahun_ajaran' => $tahun_ajaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTahunAjaranRequest $request, TahunAjaran $tahun_ajaran)
    {
        $data = $request->validated();

        $tahun_ajaran->fill($data);
        $tahun_ajaran->saveOrFail();

        return redirect()->route('master-data.tahun-ajaran.index')->with(['success' => 'Berhasil update data tahun ajaran!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAjaran $tahun_ajaran)
    {
        $tahun_ajaran->delete();

        return redirect()->route('master-data.tahun-ajaran.index')->with(['success' => 'Berhasil menghapus data tahun ajaran!']);
    }
}
