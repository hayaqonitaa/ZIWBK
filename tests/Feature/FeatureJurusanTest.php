<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Admin\Jurusan; // Tambahkan namespace yang benar untuk model Jurusan
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureJurusanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menggunakan pengguna yang terautentikasi.
     *
     * @return \App\Models\User
     */
    private function getUser()
    {
        return User::factory()->create();
    }



    /**
     * Test untuk mendapatkan semua jurusan dalam format JSON.
     *
     * @return void
     */
    public function test_get_jurusan()
    {
        Jurusan::factory()->create(['nama' => 'Jurusan Teknik Informatika']); // Menambahkan jurusan

        $response = $this->actingAs($this->getUser())->getJson(route('jurusan.data'));

        // Memastikan status HTTP adalah 200 dan respons JSON memiliki struktur yang benar
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'nama', 'created_at', 'updated_at'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan jurusan baru.
     *
     * @return void
     */
    public function test_store_jurusan()
    {
        $jurusanData = [
            'nama' => 'Jurusan Teknik Komputer'
        ];

        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
                         ->actingAs($this->getUser())
                         ->postJson(route('jurusan.store'), $jurusanData);

        // Memastikan status HTTP adalah 200, data masuk ke database, dan pesan JSON yang benar
        $response->assertStatus(200);
        $this->assertDatabaseHas('jurusan', $jurusanData);
        $response->assertJson([
            'message' => 'Jurusan berhasil ditambahkan!',
            'data' => $jurusanData,
        ]);
    }

    /**
     * Test untuk memperbarui data jurusan.
     *
     * @return void
     */
    public function test_update_jurusan()
    {
        $jurusan = Jurusan::factory()->create(['nama' => 'Jurusan Teknik Mesin']);
    
        $updateData = [
            'id' => $jurusan->id, // Pastikan ID termasuk dalam data yang dikirim
            'nama' => 'Jurusan Teknik Otomotif'
        ];
    
        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
                         ->actingAs($this->getUser())
                         ->putJson(route('jurusan.update', $jurusan->id), $updateData);
    
        // Memastikan status HTTP adalah 200, data diperbarui di database, dan pesan JSON yang benar
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Jurusan updated successfully!']);
        $this->assertDatabaseHas('jurusan', ['nama' => 'Jurusan Teknik Otomotif']);
    }
    
    /**
     * Test untuk menghapus jurusan.
     *
     * @return void
     */
    public function test_destroy_jurusan()
    {
        $jurusan = Jurusan::factory()->create();

        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
                         ->actingAs($this->getUser())
                         ->deleteJson(route('jurusan.destroy', $jurusan->id));

        // Memastikan status HTTP adalah 200, data tidak ada lagi di database, dan pesan JSON yang benar
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Jurusan berhasil dihapus!']);
        $this->assertDatabaseMissing('jurusan', ['id' => $jurusan->id]);
    }
}
