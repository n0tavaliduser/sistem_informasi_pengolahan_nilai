<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $allowedStartTimes = ['07:00', '08:15', '10:45', '12:30'];
        $endTime = '15:30';

        for ($guruId = 1; $guruId <= Guru::count(); $guruId++) {
            for ($kelasId = 1; $kelasId <= 42; $kelasId++) {
                $startTime = $allowedStartTimes[array_rand($allowedStartTimes)];
                $jamMulai = Carbon::createFromFormat('H:i', $startTime);
                $jamBerakhir = Carbon::createFromFormat('H:i', $startTime)->addMinutes($faker->numberBetween(30, 120));

                DB::table('jadwal_pelajaran')->insert([
                    'hari' => $faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
                    'jam_mulai' => $jamMulai,
                    'jam_berakhir' => $jamBerakhir > $endTime ? $endTime : $jamBerakhir,
                    'kelas_id' => $kelasId,
                    'tahun_ajaran_id' => 1,
                    'guru_id' => $guruId,
                    'semester' => $faker->randomElement(['Ganjil', 'Genap']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
