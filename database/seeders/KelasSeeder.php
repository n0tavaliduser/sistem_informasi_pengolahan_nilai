<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelasData = [
            'XII TKJ A',
            'XII TKJ B',
            'XII RPL A',
            'XII RPL B',
            'XII APAT A',
            'XII APAT B',
            'XII MM A',
            'XII MM B',
            'XII TKRO A',
            'XII TKRO B',
            'XII TBSM A',
            'XII TBSM B',
            'XII OTKP A',
            'XII OTKP B',
            'XI TKJ A',
            'XI TKJ B',
            'XI RPL A',
            'XI RPL B',
            'XI APAT A',
            'XI APAT B',
            'XI TKR A',
            'XI TKR B',
            'XI MP A',
            'XI MP B',
            'XI TSM A',
            'XI TSM B',
            'XI DKV A',
            'XI DKV B',
            'X TJKT A',
            'X TJKT B',
            'X PPLG A',
            'X PPLG B',
            'X AP A',
            'X AP B',
            'X TO A',
            'X TO B',
            'X MPLB A',
            'X MPLB B',
            'X TO C',
            'X TO D',
            'X DKV A',
            'X DKV B',
        ];

        foreach ($kelasData as $namaKelas) {
            Kelas::create([
                'nama_kelas' => $namaKelas,
                'tingkat' => (int) substr($namaKelas, 0, 2),  // Mengambil angka tingkat dari awal string
                'guru_id' => 1,  // ID guru wali kelas
                'jurusan_id' => 1,  // ID jurusan
                'tahun_ajaran_id' => 1,  // ID tahun ajaran
            ]);
        }
    }
}
