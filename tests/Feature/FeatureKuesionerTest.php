<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Admin\Kuesioner; // Pastikan model sesuai
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureKuesionerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Mendapatkan pengguna yang terautentikasi.
     *
     * @return \App\Models\User
     */
    private function getUser()
    {
        return User::factory()->create();
    }

    /**
     * Test untuk mendapatkan semua kuesioner dalam format JSON.
     *
     * @return void
     */
    public function test_get_kuesioner()
    {
        // Menambahkan data kuesioner
        Kuesioner::factory()->create([
            'judul' => 'Survey Kepuasan Mahasiswa',
            'tahun' => '2024',
            'link_kuesioner' => 'http://example.com/kuesioner',
        ]);

        $response = $this->actingAs($this->getUser())->getJson(route('kuesioner.data'));

        // Memastikan status HTTP dan struktur JSON
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'judul', 'tahun', 'link_kuesioner', 'created_at', 'updated_at'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan kuesioner baru.
     *
     * @return void
     */
    public function test_store_kuesioner()
    {
        $kuesionerData = [
            'judul' => 'Survey Kepuasan Alumni',
            'tahun' => '2024',
            'link_kuesioner' => 'http://example.com/alumni',
        ];

        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
                         ->actingAs($this->getUser())
                         ->postJson(route('kuesioner.store'), $kuesionerData);

        // Memastikan status HTTP, data ada di database, dan pesan JSON yang benar
        $response->assertStatus(200);
        $this->assertDatabaseHas('kuesioner', $kuesionerData);
        $response->assertJson([
            'message' => 'Kuesioner berhasil ditambahkan!',
            'data' => $kuesionerData,
        ]);
    }

    /**
     * Test untuk memperbarui data kuesioner.
     *
     * @return void
     */
    public function test_update_kuesioner()
    {
        // Membuat data kuesioner untuk diupdate
        $kuesioner = Kuesioner::factory()->create([
            'judul' => 'Survey Awal Tahun',
            'tahun' => '2023',
            'link_kuesioner' => 'http://example.com/survey-awal',
        ]);

        $updateData = [
            'id' => $kuesioner->id,
            'judul' => 'Survey Akhir Tahun',
            'tahun' => '2023',
            'link_kuesioner' => 'http://example.com/survey-akhir',
        ];

        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
                         ->actingAs($this->getUser())
                         ->putJson(route('kuesioner.update', $kuesioner->id), $updateData);

        // Memastikan status HTTP, data diperbarui di database, dan pesan JSON yang benar
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Kuesioner updated successfully!']);
        $this->assertDatabaseHas('kuesioner', ['judul' => 'Survey Akhir Tahun']);
    }

    /**
     * Test untuk menghapus kuesioner.
     *
     * @return void
     */
    public function test_destroy_kuesioner()
    {
        // Membuat kuesioner untuk dihapus
        $kuesioner = Kuesioner::factory()->create();

        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
                         ->actingAs($this->getUser())
                         ->deleteJson(route('kuesioner.destroy', $kuesioner->id));

        // Memastikan status HTTP, data tidak ada lagi di database, dan pesan JSON yang benar
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Kuesioner berhasil dihapus!']);
        $this->assertDatabaseMissing('kuesioner', ['id' => $kuesioner->id]);
    }
}
