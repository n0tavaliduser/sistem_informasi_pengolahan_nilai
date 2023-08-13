<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@smk.com',
                'password' => Hash::make('abcd1234'),
                'role_id' => 1,
            ],
            [
                'name' => 'Kepala Sekolah',
                'email' => 'kepala.sekolah@smk.com',
                'password' => Hash::make('abcd1234'),
                'role_id' => 2,
            ],
            [
                'name' => 'Guru',
                'email' => 'guru@smk.com',
                'password' => Hash::make('abcd1234'),
                'role_id' => 3,
            ],
            [
                'name' => 'Siswa',
                'email' => 'siswa@smk.com',
                'password' => Hash::make('abcd1234'),
                'role_id' => 4,
            ],
        ]);
    }
}
