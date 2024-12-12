<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Prodi;
use App\Models\Admin\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdiFactory extends Factory
{
    protected $model = Prodi::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'nama' => $this->faker->unique()->word,
            'id_jurusan' => Jurusan::factory(), // Pastikan JurusanFactory sudah ada
        ];
    }
}