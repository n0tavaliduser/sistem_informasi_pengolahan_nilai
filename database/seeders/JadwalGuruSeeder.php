<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\MataPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (JadwalPelajaran::pluck('id')->toArray() as $jadwalId) {
            $guru = Guru::inRandomOrder()->first(); // Ambil guru secara acak
            $mataPelajaran = MataPelajaran::inRandomOrder()->first(); // Ambil mata pelajaran secara acak

            JadwalPelajaran::where('id', $jadwalId)->update([
                'guru_id' => $guru->id,
                'mata_pelajaran_id' => $mataPelajaran->id,
            ]);
        }
    }
}
