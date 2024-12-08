<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Kuesioner;
use Illuminate\Database\Eloquent\Factories\Factory;

class KuesionerFactory extends Factory
{
    protected $model = Kuesioner::class;

    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(3),
            'tahun' => $this->faker->year,
            'link_kuesioner' => $this->faker->url,
        ];
    }
}
