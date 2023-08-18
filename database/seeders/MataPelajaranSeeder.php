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
        $mata_pelajaran = [
            'PAI3', 'KEJUR', 'PKn1', 'BIND1', 'PILIH', 'MAT2', 'PAI1', 'BING3', 'BIND4', 'PKn2',
            'PKK', 'BIND3', 'MAT1', 'BING2', 'BING1', 'PAI2', 'BING4', 'A G M'
        ];

        $mataPelajaranData = [];

        // foreach ($jurusanIds as $jurusanId) {
            foreach ($mata_pelajaran as $mata_pelajaran_code) {
                $mataPelajaranData[] = [
                    'nama' => 'Mata Pelajaran ' . $mata_pelajaran_code . ' for Jurusan ' . Jurusan::where('id', 1)->value('nama_jurusan'),
                    'kode' => $mata_pelajaran_code,
                    'keterangan' => 'Keterangan mata pelajaran ' . $mata_pelajaran_code,
                    // 'jurusan_id' => $jurusanId,
                    'jurusan_id' => 1
                ];
            }
        // }

        // Insert the data into the mata_pelajaran table
        DB::table('mata_pelajaran')->insert($mataPelajaranData);
    }
}
