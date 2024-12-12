<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    public function definition()
    {
        return [
            'nim' => $this->faker->unique()->numerify('########'),
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'id_prodi' => \App\Models\Admin\Prodi::factory(), // Pastikan Prodi memiliki factory
        ];
    }
}
