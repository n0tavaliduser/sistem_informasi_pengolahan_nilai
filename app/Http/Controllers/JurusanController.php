<?php

namespace App\Http\Controllers;

use App\Http\Requests\Jurusan\StoreJurusanRequest;
use App\Http\Requests\Jurusan\UpdateJurusanRequest;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semua_jurusan = Jurusan::query()
            ->where(function ($query) use ($request) {
                $query->where('nama_jurusan', 'LIKE', '%' . $request->get('find') . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $request->get('find') . '%');
            })
            ->orderBy('nama_jurusan', 'ASC')
            ->paginate(10);

        return view('pages.master-data.jurusan.index', [
            'semua_jurusan' => $semua_jurusan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJurusanRequest $request)
    {
        $data = $request->validated();

        $jurusan = Jurusan::make($data);
        $jurusan->saveOrFail();

        return redirect()->route('master-data.jurusan.index')->with(['success' => 'Berhasil menambahkan jurusan baru!']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJurusanRequest $request, Jurusan $jurusan)
    {
        $data = $request->validated();
        
        $jurusan->fill($data);
        $jurusan->saveOrFail();

        return redirect()->route('master-data.jurusan.index')->with(['success' => 'Berhasil update data jurusan!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('master-data.jurusan.index')->with(['success' => 'Berhasil menghapus jurusan!']);
    }
}
