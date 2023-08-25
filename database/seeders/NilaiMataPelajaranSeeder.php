<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiMataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = Siswa::all();

        foreach ($siswas as $siswa) {
            foreach (MataPelajaran::with('jadwal_pelajarans')->whereHas('jadwal_pelajarans.kelas.siswas',  function ($query) use ($siswa) {$query->where('id', $siswa->id);})->get() as $mata_pelajaran) {
                for ($pertemuan = 1; $pertemuan < 3; $pertemuan++) {
                    DB::table('nilai_mata_pelajaran')->insert([
                        [
                            'siswa_id' => $siswa->id,
                            'mata_pelajaran_id' => $mata_pelajaran->id,
                            'nilai' => rand(50, 100),
                            'pertemuan' => $pertemuan
                        ]
                    ]);
                }
            }
        }
    }
}
