<?php

namespace Tests\Feature\konten;

use App\Models\User;
use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FeatureKontenPiagamTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        return User::factory()->create();
    }

    private function getCategory()
    {
        return ContentCategories::create([
            'id' => '8101bdbf-d3a4-4859-9691-95fa7a9c8e88',
            'nama' => 'Piagam',
        ]);
    }

    /**
     * Test untuk mendapatkan data konten piagam dalam format JSON.
     */
    public function test_get_piagam()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $response = $this->actingAs($this->getUser())->getJson(route('konten.piagam.data'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'judul', 'deskripsi', 'file', 'status', 'id_kategori'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan data konten piagam baru.
     */
    public function test_store_piagam()
    {
        $category = $this->getCategory();
        $file = UploadedFile::fake()->image('sample.jpg');
        $contentData = [
            'judul' => 'Piagam Baru',
            'deskripsi' => 'Deskripsi piagam baru.',
            'file' => $file,
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.piagam.store'), $contentData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'judul' => 'Piagam Baru',
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
        Storage::disk('public')->assertExists('uploads/' . $file->hashName());
        $response->assertJson(['message' => 'Content Piagam berhasil ditambahkan.']);
    }

    /**
     * Test untuk memperbarui data konten piagam.
     */
    public function test_update_piagam()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $updateData = [
            'judul' => 'Piagam Diperbarui',
            'deskripsi' => 'Deskripsi piagam diperbarui.',
            'status' => 'Tidak Aktif',
            'id_kategori' => $category->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.piagam.update', $content->id), $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'id' => $content->id,
            'judul' => 'Piagam Diperbarui',
            'status' => 'Tidak Aktif',
        ]);
        $response->assertJson(['message' => 'Content Piagam berhasil diperbarui.']);
    }

    /**
     * Test untuk menghapus konten piagam.
     */
    public function test_destroy_piagam()
    {
        $content = Content::factory()->create();

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->deleteJson(route('konten.piagam.destroy', $content->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('content', ['id' => $content->id]);
        $response->assertJson(['message' => 'Content deleted successfully.']);
    }
}
