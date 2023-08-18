<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Role;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $jumlah_siswa = rand(10, 12);

        $dataCount = 1;
        foreach (Kelas::pluck('id') as $index => $kelasId) {
            for ($i = 0; $i < $jumlah_siswa; $i++) {
                $user = User::create([
                    'name' => 'siswa' . $dataCount,
                    'email' => 'siswa' . $index + 1 . '_' . $i . '@smk.com',
                    'password' => Hash::make('abcd1234'),
                    'role_id' => Role::where('name', 'Siswa')->first()->id,
                ]);
    
                DB::table('siswa')->insert([
                    [
                        'nomor_induk' => $faker->unique()->numerify('######'), // how to make unique nomor_induk
                        'nama_lengkap' => 'Nama Lengkap Siswa ' . $dataCount,
                        'agama' => $faker->randomElement(['Islam', 'Kristen', 'Budha']),
                        'status' => 'active',
                        'jenis_kelamin' => $faker->randomElement(['Perempuan', 'Laki-laki']),
                        'tempat_lahir' => $faker->city,
                        'tanggal_lahir' => $faker->dateTimeBetween('-19 years', '-15 years'),
                        'alamat' => $faker->address,
                        'telepon' => $faker->phoneNumber,
                        'email' => $user->email,
                        'kelas_id' => $kelasId,
                        'tahun_ajaran_id' => TahunAjaran::where('status', 'active')->first()->id,
                        'user_id' => $user->id
                    ]
                ]);

                $dataCount += 1;
            } 
        }

    }
}
