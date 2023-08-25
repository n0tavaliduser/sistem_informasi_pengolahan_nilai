<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = Siswa::all();
        
        foreach ($siswas as $siswa) {
            foreach (MataPelajaran::with('jadwal_pelajarans')->whereHas('jadwal_pelajarans.kelas.siswas',  function ($query) use ($siswa) {$query->where('id', $siswa->id);})->get() as $mata_pelajaran) {
                DB::table('nilai')->insert([
                    [
                        'siswa_id' => $siswa->id,
                        'mata_pelajaran_id' => $mata_pelajaran->id,
                        'nilai' => rand(50, 100),
                    ]
                ]);
            }
        }
    }
}
