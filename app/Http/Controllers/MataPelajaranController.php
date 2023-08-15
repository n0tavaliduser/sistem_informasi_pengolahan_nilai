<?php

namespace App\Http\Controllers;

use App\Http\Requests\MataPelajaran\StoreMataPelajaranRequest;
use App\Http\Requests\MataPelajaran\UpdateMataPelajaranRequest;
use App\Models\Jurusan;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semua_mata_pelajaran = MataPelajaran::query()
            ->where(function ($query) use ($request) {
                $query->where('nama', 'LIKE', '%' . $request->get('find') . '%');
            })
            ->paginate(10);
        $semua_jurusan = Jurusan::orderBy('nama_jurusan', 'ASC')->get();

        return view('pages.master-data.mata-pelajaran.index', [
            'semua_mata_pelajaran' => $semua_mata_pelajaran,
            'semua_jurusan' => $semua_jurusan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMataPelajaranRequest $request)
    {
        $data = $request->validated();

        $mata_pelajaran = MataPelajaran::make($data);
        $mata_pelajaran->saveOrFail();

        return redirect()->route('master-data.mata-pelajaran.index')->with(['success' => 'Berhasil menambahkan mata pelajaran baru!']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMataPelajaranRequest $request, MataPelajaran $mata_pelajaran)
    {
        $data = $request->validated();

        $mata_pelajaran->fill($data);
        $mata_pelajaran->saveOrFail();

        return redirect()->route('master-data.mata-pelajaran.index')->with(['success' => 'Berhasil update data mata pelajaran!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataPelajaran $mata_pelajaran)
    {
        $mata_pelajaran->delete();
        
        return redirect()->route('master-data.mata-pelajaran.index')->with(['success' => 'Berhasil menghapus mata pelajaran!']);
    }
}
