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
        DB::table('jurusan')->insert([
            [
                'nama_jurusan' => 'Teknik Komputer dan Jaringan',
                'keterangan' => 'Jurusan yang mempelajari tentang teknik komputer dan jaringan.',
            ],
            [
                'nama_jurusan' => 'Akuntansi',
                'keterangan' => 'Jurusan yang mempelajari tentang akuntansi dan keuangan.',
            ],
            [
                'nama_jurusan' => 'Rekayasa Perangkat Lunak',
                'keterangan' => 'Jurusan yang mempelajari tentang pengembangan perangkat lunak.',
            ],
            [
                'nama_jurusan' => 'Multimedia',
                'keterangan' => 'Jurusan yang mempelajari tentang desain grafis, audio, dan video.',
            ],
            [
                'nama_jurusan' => 'Teknik Elektronika Industri',
                'keterangan' => 'Jurusan yang mempelajari tentang teknik elektronika dalam industri.',
            ],
            [
                'nama_jurusan' => 'Tata Boga',
                'keterangan' => 'Jurusan yang mempelajari tentang seni kuliner dan masakan.',
            ],
            [
                'nama_jurusan' => 'Tata Busana',
                'keterangan' => 'Jurusan yang mempelajari tentang desain dan konstruksi pakaian.',
            ],
            [
                'nama_jurusan' => 'Otomotif',
                'keterangan' => 'Jurusan yang mempelajari tentang teknik otomotif dan kendaraan.',
            ],
            [
                'nama_jurusan' => 'Teknik Listrik',
                'keterangan' => 'Jurusan yang mempelajari tentang teknik listrik dan elektronika.',
            ],
            [
                'nama_jurusan' => 'Agribisnis',
                'keterangan' => 'Jurusan yang mempelajari tentang bisnis di bidang pertanian.',
            ],
            [
                'nama_jurusan' => 'Bisnis Manajemen',
                'keterangan' => 'Jurusan yang mempelajari tentang manajemen bisnis dan usaha.',
            ],
            [
                'nama_jurusan' => 'Desain Interior',
                'keterangan' => 'Jurusan yang mempelajari tentang desain interior ruangan.',
            ],
            [
                'nama_jurusan' => 'Desain Grafis',
                'keterangan' => 'Jurusan yang mempelajari tentang desain grafis dan visual.',
            ],
            [
                'nama_jurusan' => 'Pemasaran',
                'keterangan' => 'Jurusan yang mempelajari tentang strategi pemasaran dan penjualan.',
            ],
            [
                'nama_jurusan' => 'Kimia Analisis',
                'keterangan' => 'Jurusan yang mempelajari tentang analisis kimia dan laboratorium.',
            ],
            [
                'nama_jurusan' => 'Kesehatan',
                'keterangan' => 'Jurusan yang mempelajari tentang bidang kesehatan dan perawatan.',
            ],
            [
                'nama_jurusan' => 'Perhotelan',
                'keterangan' => 'Jurusan yang mempelajari tentang industri perhotelan dan pariwisata.',
            ],
            [
                'nama_jurusan' => 'Teknik Sipil',
                'keterangan' => 'Jurusan yang mempelajari tentang teknik sipil dan konstruksi.',
            ],
            [
                'nama_jurusan' => 'Penerbangan',
                'keterangan' => 'Jurusan yang mempelajari tentang penerbangan dan aviasi.',
            ],
            [
                'nama_jurusan' => 'Kendaraan Ringan',
                'keterangan' => 'Jurusan yang mempelajari tentang perawatan kendaraan ringan.',
            ],
            [
                'nama_jurusan' => 'Pengolahan Makanan',
                'keterangan' => 'Jurusan yang mempelajari tentang pengolahan makanan dan minuman.',
            ],
        ]);
    }
}
