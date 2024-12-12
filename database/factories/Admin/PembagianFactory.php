<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Kuesioner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Pembagian>
 */
class PembagianFactory extends Factory
{
    protected $model = \App\Models\Admin\Pembagian::class;

    public function definition()
    {
        return [
            'id_mahasiswa' => \App\Models\Admin\Mahasiswa::factory(),
            'id_kuesioner' => \App\Models\Admin\Kuesioner::factory(),
            'status' => $this->faker->randomElement(['Belum Dikirim', 'Sudah Terkirim']),
        ];
    }
}
