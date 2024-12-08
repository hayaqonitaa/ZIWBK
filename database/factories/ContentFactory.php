<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\ContentCategories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'id_admin' => User::factory(),
            'id_kategori' => ContentCategories::factory(),
            'judul' => $this->faker->sentence,
            'deskripsi' => $this->faker->paragraph,
            'file' => $this->faker->word . '.jpg', // File dummy
            'link' => $this->faker->url, // URL dummy
            'status' => 'Aktif',
        ];
    }
}
