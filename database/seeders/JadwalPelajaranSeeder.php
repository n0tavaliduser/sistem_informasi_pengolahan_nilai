<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalPelajaranSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $data_kelas = Kelas::all();
        $data_jam_mulai = ['07:30', '08:15', '09:00', '09:45', '10:45', '11:30', '12:30', '13:15', '14:00', '14:45'];
        $data_jam_mulai_jumat = ['7:15', '8:00', '8:45', '9:30', '10:30', '11:15', '13:15', '14:00', '14:45'];
        $data_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        foreach ($data_kelas as $kelas) {
            foreach ($data_hari as $hari) {

                // hari senin hilangkan jam 07:30 sebagai jam mulai pelajaran
                if ($hari == 'Senin') {
                    $index_to_remove = array_search('07:30', $data_jam_mulai);
                    if ($index_to_remove !== false) {
                        unset($data_jam_mulai[$index_to_remove]);
                    }
                }

                if ($hari != 'Jumat') {
                    foreach ($data_jam_mulai as $jam_mulai) {
                        DB::table('jadwal_pelajaran')->insert(array(
                            [
                                'hari' => $hari,
                                'jam_mulai' => $jam_mulai,
                                'jam_berakhir' => Carbon::createFromFormat('H:i', $jam_mulai)->addMinutes(45),
                                'kelas_id' => $kelas->id,
                                'tahun_ajaran_id' => TahunAjaran::where('status', 'active')->first()->id,  
                                'semester' => 'Ganjil'
                            ]
                        ));
                    }
                } else {
                    foreach ($data_jam_mulai_jumat as $jam_mulai) {
                        DB::table('jadwal_pelajaran')->insert(array(
                            [
                                'hari' => $hari,
                                'jam_mulai' => $jam_mulai,
                                'jam_berakhir' => Carbon::createFromFormat('H:i', $jam_mulai)->addMinutes(45),
                                'kelas_id' => $kelas->id,
                                'tahun_ajaran_id' => TahunAjaran::where('status', 'active')->first()->id,  
                                'semester' => 'Ganjil'
                            ]
                        ));
                    }
                }
            }
        }
    }
}
