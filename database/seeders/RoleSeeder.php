<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'description' => 'Peran untuk administrator dengan akses penuh ke sistem.',
            ],
            [
                'name' => 'Kepala Sekolah',
                'description' => 'Peran untuk kepala sekolah dengan akses dan hak istimewa tertentu.',
            ],
            [
                'name' => 'Guru',
                'description' => 'Peran untuk guru dengan akses ke fitur pengajaran dan penilaian.',
            ],
            [
                'name' => 'Siswa',
                'description' => 'Peran untuk siswa dengan akses terbatas ke informasi dan tugas mereka sendiri.',
            ],
        ]);
    }
}
