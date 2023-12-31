<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            JurusanSeeder::class,
            MataPelajaranSeeder::class,
            GuruSeeder::class,
            TahunAjaranSeeder::class,
            KelasSeeder::class,
            JadwalPelajaranSeeder::class,
            // JadwalGuruSeeder::class,
            SiswaSeeder::class,
            NilaiSeeder::class,
            NilaiMataPelajaranSeeder::class,
            AbsensiSeeder::class
        ]);
    }
}
