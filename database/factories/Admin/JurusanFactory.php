<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin\Jurusan;

class JurusanFactory extends Factory
{
    protected $model = Jurusan::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'nama' => $this->faker->unique()->word,
        ];
    }
}
