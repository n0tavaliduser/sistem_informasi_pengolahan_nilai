<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\TahunAjaran;

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

        foreach ($kelasData as $index => $namaKelas) {
            // Extract the Roman numeral part (X, XI, XII) from the class name
            preg_match('/^(XII|XI|X)\s/', $namaKelas, $matches);
        
            // Map the Roman numerals to their numeric values
            $romanToNumeric = [
                'X' => 10,
                'XI' => 11,
                'XII' => 12,
            ];
        
            // Get the Roman numeral from the match
            $romanNumeral = isset($matches[1]) ? $matches[1] : null;
        
            // Get the corresponding numeric value
            $tingkat = isset($romanToNumeric[$romanNumeral]) ? $romanToNumeric[$romanNumeral] : null;
        

            Kelas::create([
                'nama_kelas' => $namaKelas,
                'tingkat' => $tingkat,  // Mengambil angka tingkat dari awal string
                'guru_id' => $index + 1,  // ID guru wali kelas
                'jurusan_id' => Guru::where('id', $index + 1)->first()->jurusan->id,  // ID jurusan
                'tahun_ajaran_id' => TahunAjaran::where('status', 'active')->first()->id,  // ID tahun ajaran
            ]);
        }
    }
}
