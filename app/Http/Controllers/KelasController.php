<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kelas\StoreKelasRequest;
use App\Http\Requests\Kelas\UpdateKelasRequest;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $data_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $data_jam_mulai = ['07:30', '08:15', '09:00', '09:45', '10:45', '11:30', '12:30', '13:15', '14:00', '14:45'];
        $data_jam_mulai_jumat = ['7:15', '8:00', '8:45', '9:30', '10:30', '11:15', '13:15', '14:00', '14:45'];

        foreach ($data_hari as $hari) {

            // hari senin hilangkan jam 07:30 sebagai jam mulai pelajaran
            if ($hari == 'Senin') {
                $index_to_remove = array_search('07:30', $data_jam_mulai);
                if ($index_to_remove !== false) {
                    unset($data_jam_mulai[$index_to_remove]);
                }
            }

            $mata_pelajarans = MataPelajaran::pluck('id')->toArray();
            $gurus = Guru::pluck('id')->toArray();

            if ($hari != 'Jumat') {
                foreach ($data_jam_mulai as $jam_mulai) {
                    DB::table('jadwal_pelajaran')->insert(array(
                        [
                            'hari' => $hari,
                            'jam_mulai' => $jam_mulai,
                            'jam_berakhir' => Carbon::createFromFormat('H:i', $jam_mulai)->addMinutes(45),
                            'kelas_id' => $kelas->id,
                            'tahun_ajaran_id' => TahunAjaran::where('status', 'active')->first()->id,
                            'semester' => 'Ganjil',
                        ]
                    ));
                }
            } else {
                foreach ($data_jam_mulai_jumat as $jam_mulai) {
                    DB::table('jadwal_pelajaran')->insert(array(
                        [
                            'hari' => $hari,
                            'jam_mulai' => $jam_mulai,
                            'jam_berakhir' => Carbon::createFromFormat('H:i', $jam_mulai)->addMinutes(45),
                            'kelas_id' => $kelas->id,
                            'tahun_ajaran_id' => TahunAjaran::where('status', 'active')->first()->id,  
                            'semester' => 'Ganjil',
                        ]
                    ));
                }
            }
        }

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
