<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

use function Illuminate\Events\queueable;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $userGuru = User::where('role_id', Role::where('name', 'Guru')->first()->id)->get();
        foreach ($userGuru as $guru) {
            DB::table('guru')->insert([
                'user_id' => $guru->id,
                'nama_lengkap' => $guru->name,
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => $faker->dateTimeBetween('-35 years', '-28 years'),
                'alamat' => $faker->address,
                'jurusan_id' => 1,
            ]);
        }

        $guruData = [
            [
                'nama_lengkap' => 'Fatmawati, S.Pd., M.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1971-02-03',
                'alamat' => 'Alamat Fatmawati',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Dr. Lisa Said, M.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1980-11-24',
                'alamat' => 'Alamat Lisa Said',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Yatirah, S.Ag.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1968-12-31',
                'alamat' => 'Alamat Yatirah',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Nurlina, S.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1969-08-03',
                'alamat' => 'Alamat Nurlina',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Ainuridha, S.Pi.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1975-01-16',
                'alamat' => 'Alamat Ainuridha',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Anthonius Tanduk, S.Pi., Gr',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1967-08-08',
                'alamat' => 'Alamat Anthonius Tanduk',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Isnaeni, S.Pd. NI PPPK',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1995-02-06',
                'alamat' => 'Alamat Isnaeni',
                'jurusan_id' => 3, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'S. Aminuddin ASS, S.Kom., Gr',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1989-04-28',
                'alamat' => 'Alamat S. Aminuddin',
                'jurusan_id' => 3, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Anna Amaliah, S.Pd., M.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1991-05-29',
                'alamat' => 'Alamat Anna Amaliah',
                'jurusan_id' => 6, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Drs. Mustamin',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1965-01-06',
                'alamat' => 'Alamat Drs. Mustamin',
                'jurusan_id' => 6, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Ir. Juhrah',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1965-02-24',
                'alamat' => 'Alamat Ir. Juhrah',
                'jurusan_id' => 4, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Mariani, S.Si.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1974-11-02',
                'alamat' => 'Alamat Mariani',
                'jurusan_id' => 4, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Nuraeni Kasim, S.Pd., Gr.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1977-11-26',
                'alamat' => 'Alamat Nuraeni Kasim',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Suharni Satullah, S.Pd. NI PPPK',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-12-18',
                'alamat' => 'Alamat Suharni Satullah',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Muzakkir, S.Pd., M.T.',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1979-10-05',
                'alamat' => 'Alamat Muzakkir',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Hasbiah, S.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Hasbiah',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Hasniati, S.Kom.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Hasniati',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Irmawaty Syafruddin, S.Pd. NI PPPK',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1981-07-08',
                'alamat' => 'Alamat Irmawaty Syafruddin',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Faharuddin, S.Pi.',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1976-11-08',
                'alamat' => 'Alamat Faharuddin',
                'jurusan_id' => 4, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Dina Otong Pakiding, S.Pi.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1975-12-23',
                'alamat' => 'Alamat Dina Otong Pakiding',
                'jurusan_id' => 4, // Set the appropriate jurusan_id
            ], [
                'nama_lengkap' => 'Rahmatia, S.Pi.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Rahmatia',
                'jurusan_id' => 4, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Irwan, S.Pd., M.Pd. NI PPPK',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1993-05-03',
                'alamat' => 'Alamat Irwan',
                'jurusan_id' => 4, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Ikhwanul Ihsan, S.Pd. NI PPPK',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1996-10-12',
                'alamat' => 'Alamat Ikhwanul Ihsan',
                'jurusan_id' => 3, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Ahmad Taufik Sudirman, S.Pd.',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Ahmad Taufik Sudirman',
                'jurusan_id' => 3, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Ismail Ranjan, S.Pd. NI PPPK',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1987-11-01',
                'alamat' => 'Alamat Ismail Ranjan',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Rasmiati Amir, S.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1982-02-17',
                'alamat' => 'Alamat Rasmiati Amir',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Rahmawati, S.Pd.I.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Rahmawati',
                'jurusan_id' => 4, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Harnawati, S.Kom. NIP 197712212015082001',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Harnawati',
                'jurusan_id' => 4, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Muh. Arief, S.Pd.',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Muh. Arief',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Ir. Faiza Shofiati',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1965-12-11',
                'alamat' => 'Alamat Ir. Faiza Shofiati',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Asdar, S.Pd. NI PPPK',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1976-05-08',
                'alamat' => 'Alamat Asdar',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Sumiati, S.Pd., Gr',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1986-03-29',
                'alamat' => 'Alamat Sumiati',
                'jurusan_id' => 1, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Suriati, S.Pi.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1974-07-04',
                'alamat' => 'Alamat Suriati',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Rante Labi, S.Pd., M.Pd.',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1972-11-07',
                'alamat' => 'Alamat Rante Labi',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Kamal Qarim, S.Pd.',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Kamal Qarim',
                'jurusan_id' => 5, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Dra. Harmiah',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1965-05-03',
                'alamat' => 'Alamat Dra. Harmiah',
                'jurusan_id' => 5, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Ir. N. Dewi Saptawati',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1966-09-18',
                'alamat' => 'Alamat Ir. N. Dewi Saptawati',
                'jurusan_id' => 5, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Mardiana, S.S., S.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Mardiana',
                'jurusan_id' => 5, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Lestari, S.Pd. NI PPPK',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1986-04-04',
                'alamat' => 'Alamat Lestari',
                'jurusan_id' => 6, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Kasmawati, S.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1975-10-10',
                'alamat' => 'Alamat Kasmawati',
                'jurusan_id' => 6, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Andi Masbaya, S.S., Gr.',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1983-03-04',
                'alamat' => 'Alamat Andi Masbaya',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
            [
                'nama_lengkap' => 'Herlina, S.Pd.',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-01-01', // Replace with the appropriate date
                'alamat' => 'Alamat Herlina',
                'jurusan_id' => 2, // Set the appropriate jurusan_id
            ],
        ];

        foreach ($guruData as $item) {
            $nameParts = explode(' ', $item['nama_lengkap']);
            $lastName = array_pop($nameParts); // Get the last part as the last name
            $firstName = implode(' ', $nameParts);

            $baseEmail = strtolower($lastName);
            $email = $baseEmail . '@smk.com';
            $numericSuffix = 1;

            // Handle duplicate email
            while (User::where('email', $email)->exists()) {
                $email = $baseEmail . $numericSuffix . '@smk.com';
                $numericSuffix++;
            }

            $userData = [
                'name' => $firstName,
                'email' => $email,
                'password' => Hash::make('abcd1234'),
                'role_id' => Role::where('name', 'Guru')->first()->id,
            ];

            $user = User::create($userData);

            $item['user_id'] = $user->id;
            // unset($item['nama_lengkap']);

            Guru::create($item);
        }
    }
}
