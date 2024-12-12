<?php

namespace Database\Factories;

use App\Models\ContentCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentCategoriesFactory extends Factory
{
    protected $model = ContentCategories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->word(), // Menggunakan Faker untuk menghasilkan nama kategori acak
        ];
    }
}
