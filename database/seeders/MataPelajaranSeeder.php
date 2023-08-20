<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed data for the mata_pelajaran table
        $mata_pelajaran_kepanjangan = [
            'PAI3' => 'Pendidikan Agama Islam 3',
            'KEJUR' => 'Kejuruan',
            'PKn1' => 'Pendidikan Kewarganegaraan 1',
            'BIND1' => 'Bahasa Indonesia 1',
            'PILIH' => 'Mata Pelajaran Pilihan',
            'MAT2' => 'Matematika 2',
            'PAI1' => 'Pendidikan Agama Islam 1',
            'BING3' => 'Bahasa Inggris 3',
            'BIND4' => 'Bahasa Indonesia 4',
            'PKn2' => 'Pendidikan Kewarganegaraan 2',
            'PKK' => 'Pendidikan Keterampilan Khusus',
            'BIND3' => 'Bahasa Indonesia 3',
            'MAT1' => 'Matematika 1',
            'BING2' => 'Bahasa Inggris 2',
            'BING1' => 'Bahasa Inggris 1',
            'PAI2' => 'Pendidikan Agama Islam 2',
            'BING4' => 'Bahasa Inggris 4',
            'A G M' => 'Agama, Etika, dan Moral'
        ];

        $mataPelajaranData = [];

        foreach ($mata_pelajaran_kepanjangan as $kode => $nama) {
            $mataPelajaranData[] = [
                'nama' => $nama,
                'kode' => $kode,
                'keterangan' => 'Keterangan mata pelajaran ' . $kode,
                'jurusan_id' => 1
            ];
        }

        // Insert the data into the mata_pelajaran table
        DB::table('mata_pelajaran')->insert($mataPelajaranData);
    }
}
