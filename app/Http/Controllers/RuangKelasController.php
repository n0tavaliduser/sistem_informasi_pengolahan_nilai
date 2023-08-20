<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RuangKelasController extends Controller
{
    public function daftarKelas()
    {
        $daysOfWeekInIndonesian = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            0 => 'Minggu',
        ];
    
        $semua_jadwal = JadwalPelajaran::with('guru', 'kelas.siswas')
            ->where(function ($query) {
                $query->whereHas('guru', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->orWhere(function ($query) {
                    $query->whereHas('guru')
                        ->whereHas('kelas.siswas', function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    });
                });
            })
            ->whereDate('jadwal_pelajaran.hari', $daysOfWeekInIndonesian[Carbon::now()->dayOfWeek])
            ->paginate(8);

        // dd($semua_jadwal);

        return view('pages.kelas._daftar_kelas', [
            'semua_jadwal' => $semua_jadwal
        ]);
    }

    public function ruangKelas(JadwalPelajaran $jadwal)
    {
        return view('pages.kelas._ruang_kelas', [
            'jadwal' => $jadwal
        ]);
    }
}
