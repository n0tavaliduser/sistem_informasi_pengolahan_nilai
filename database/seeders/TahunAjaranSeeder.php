<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tahun_ajaran')->insert([
            [
                'tahun_mulai' => '2021',
                'tahun_berakhir' => '2022',
                'jumlah_semester' => 2,
                'status' => 'deactive'
            ],
            [
                'tahun_mulai' => '2022',
                'tahun_berakhir' => '2023',
                'jumlah_semester' => 2,
                'status' => 'deactive'
            ],
            [
                'tahun_mulai' => '2023',
                'tahun_berakhir' => '2024',
                'jumlah_semester' => 2,
                'status' => 'active'
            ]
        ]);
    }
}
