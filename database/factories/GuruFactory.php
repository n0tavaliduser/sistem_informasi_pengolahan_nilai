<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class GuruFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Guru::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get all jurusan IDs
        $jurusanIds = Jurusan::pluck('id')->toArray();

        // Fake data
        $name = $this->faker->name;

        $user = User::make([
            'name' => $name,
            'email' => str_replace(' ', '', $name) . '@smk.com',
            'password' => Hash::make(str_replace(' ', '', $name)),
            'role_id' => Role::where('name', 'Guru')->first()->id,
        ]);
        $user->saveOrFail();

        return [
            'nama_lengkap' => $name,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-20 years'),
            'alamat' => $this->faker->address,
            'jurusan_id' => $this->faker->randomElement($jurusanIds),
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
