<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get jurusan IDs from the database
        $jurusanIds = DB::table('jurusan')->orderBy('nama_jurusan', 'ASC')->pluck('id');

        // Seed data for the mata_pelajaran table
        $mataPelajaranData = [];

        foreach ($jurusanIds as $jurusanId) {
            for ($i = 1; $i <= rand(8, 12); $i++) { // Remove the extra increment here
                $mataPelajaranData[] = [
                    'nama' => 'Mata Pelajaran ' . $i . ' for Jurusan ' . Jurusan::where('id', $jurusanId)->get()->first()->nama_jurusan,
                    'keterangan' => 'Keterangan Mata Pelajaran ' . $i,
                    'jurusan_id' => $jurusanId,
                ];
            }
        }

        // Insert the data into the mata_pelajaran table
        DB::table('mata_pelajaran')->insert($mataPelajaranData);
    }
}
