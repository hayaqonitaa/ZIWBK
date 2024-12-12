<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\ContentCategories; // Pastikan model yang sesuai untuk ContentCategories
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureContentCategoriesTest extends TestCase
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
     * Test untuk mendapatkan semua kategori konten dalam format JSON.
     *
     * @return void
     */
    public function test_get_content_categories()
    {
        // Menambahkan kategori konten
        ContentCategories::factory()->create(['nama' => 'Kategori A']); 

        $response = $this->actingAs($this->getUser())->getJson(route('content-categories.data'));

        // Memastikan status HTTP adalah 200 dan respons JSON memiliki struktur yang benar
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'nama', 'created_at', 'updated_at'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan kategori konten baru.
     *
     * @return void
     */
    public function test_store_content_category()
    {
        $categoryData = [
            'nama' => 'Kategori B'
        ];

        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
                         ->actingAs($this->getUser())
                         ->postJson(route('content_categories.store'), $categoryData);

        // Memastikan status HTTP adalah 200, data masuk ke database, dan pesan JSON yang benar
        $response->assertStatus(200);
        $this->assertDatabaseHas('content_categories', $categoryData);
        $response->assertJson([
            'message' => 'Kategori konten berhasil ditambahkan!',
            'data' => $categoryData,
        ]);
    }

    /**
     * Test untuk memperbarui data kategori konten.
     *
     * @return void
     */
    public function test_update_content_category()
    {
        // Buat kategori konten untuk diupdate
        $category = ContentCategories::factory()->create(['nama' => 'Kategori C']);
    
        $updateData = [
            'id' => $category->id, // Pastikan ID termasuk dalam data yang dikirim
            'nama' => 'Kategori D'
        ];
    
        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
                         ->actingAs($this->getUser())
                         ->putJson(route('content_categories.update', $category->id), $updateData);
    
        // Memastikan status HTTP adalah 200, data diperbarui di database, dan pesan JSON yang benar
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Kategori konten berhasil diperbarui!']);
        $this->assertDatabaseHas('content_categories', ['nama' => 'Kategori D']);
    }
    
    /**
     * Test untuk menghapus kategori konten.
     *
     * @return void
     */
    public function test_destroy_content_category()
    {
        // Buat kategori konten untuk dihapus
        $category = ContentCategories::factory()->create();

        // Menonaktifkan middleware CSRF
        $response = $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
                         ->actingAs($this->getUser())
                         ->deleteJson(route('content-categories.destroy', $category->id));

        // Memastikan status HTTP adalah 200, data tidak ada lagi di database, dan pesan JSON yang benar
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Kategori konten berhasil dihapus!']);
        $this->assertDatabaseMissing('content_categories', ['id' => $category->id]);
    }
}
