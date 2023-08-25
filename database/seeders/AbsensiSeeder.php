<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semua_siswa = Siswa::all();

        $tanggals = ['31-07-2023', '01-08-2023', '02-08-2023', '03-08-2023', '04-08-2023'];

        for ($day = 0; $day <= 2; $day++) {
            $tanggal_mulai = $tanggals[rand(0, count($tanggals) - 1)];
            foreach ($semua_siswa as $siswa) {
                foreach (MataPelajaran::with('jadwal_pelajarans')->whereHas('jadwal_pelajarans.kelas.siswas',  function ($query) use ($siswa) {
                    $query->where('id', $siswa->id);
                })->get() as $mata_pelajaran) {
                    $keterangan = ['Hadir', 'Hadir', 'Hadir', 'Hadir', 'Hadir', 'Hadir', 'Hadir', 'Izin', 'Alpha'];
                    DB::table('absensi')->insert([
                        [
                            'tanggal' => \Carbon\Carbon::parse($tanggal_mulai)->addDays($day * 7)->format('Y-m-d'),
                            'siswa_id' => $siswa->id,
                            'kelas_id' => $siswa->kelas?->id,
                            'tahun_ajaran_id' => TahunAjaran::where('status', 'active')->first()->id,
                            'semester' => 'Ganjil',
                            'mata_pelajaran_id' => $mata_pelajaran->id,
                            'keterangan' => $keterangan[rand(0, count($keterangan) - 1)]
                        ]
                    ]);
                }
            }
        }
    }
}
