<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusanData = [
            [
                'nama_jurusan' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                'singkatan' => 'TJKT',
                'keterangan' => 'Jurusan yang mempelajari tentang teknik komputer dan jaringan.',
            ],
            [
                'nama_jurusan' => 'Agribisnis Perikanan',
                'singkatan' => 'AP',
                'keterangan' => 'Jurusan yang mempelajari tentang agribisnis perikanan.',
            ],
            [
                'nama_jurusan' => 'Manajemen Perkantoran dan Layanan Bisnis',
                'singkatan' => 'MPLB',
                'keterangan' => 'Jurusan yang mempelajari tentang manajemen perkantoran dan layanan bisnis.',
            ],
            [
                'nama_jurusan' => 'Pengembangan Perangkat Lunak dan Gim',
                'singkatan' => 'PPLG',
                'keterangan' => 'Jurusan yang mempelajari tentang pengembangan perangkat lunak dan gim.',
            ],
            [
                'nama_jurusan' => 'Desain Komunikasi Visual',
                'singkatan' => 'DKV',
                'keterangan' => 'Jurusan yang mempelajari tentang desain komunikasi visual.',
            ],
            [
                'nama_jurusan' => 'Teknik Otomotif',
                'singkatan' => 'TO',
                'keterangan' => 'Jurusan yang mempelajari tentang teknik otomotif.',
            ],
        ];

        foreach ($jurusanData as $item) {
            DB::table('jurusan')->insert($item);
        }
    }
}
