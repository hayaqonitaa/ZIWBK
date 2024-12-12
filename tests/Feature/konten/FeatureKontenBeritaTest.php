<?php

namespace Tests\Feature\konten;

use App\Models\User;
use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FeatureKontenBeritaTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        return User::factory()->create();
    }

    private function getCategory()
    {
        return ContentCategories::create([
            'id' => '6d147c7e-1185-4453-87b7-edfe86ee66bc', // ID kategori Berita
            'nama' => 'Berita',
        ]);
    }

    /**
     * Test untuk mendapatkan data konten berita dalam format JSON.
     */
    public function test_get_berita()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $response = $this->actingAs($this->getUser())->getJson(route('konten.berita.data'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'judul', 'deskripsi', 'file', 'status', 'id_kategori'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan data konten berita baru.
     */
    public function test_store_berita()
    {
        $category = $this->getCategory();
        $file = UploadedFile::fake()->create('sample.jpg', 500, 'image/jpeg');
        $contentData = [
            'judul' => 'Berita Baru',
            'deskripsi' => 'Deskripsi berita baru.',
            'file' => $file,
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.berita.store'), $contentData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'judul' => 'Berita Baru',
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
        Storage::disk('public')->assertExists('uploads/' . $file->hashName());
        $response->assertJson(['message' => 'Berita created successfully.']);
    }

    /**
     * Test untuk memperbarui data konten berita.
     */
    public function test_update_berita()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $updateData = [
            'judul' => 'Berita Diperbarui',
            'deskripsi' => 'Deskripsi berita diperbarui.',
            'status' => 'Tidak Aktif',
            'id_kategori' => $category->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.berita.update', $content->id), $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'id' => $content->id,
            'judul' => 'Berita Diperbarui',
            'status' => 'Tidak Aktif',
        ]);
        $response->assertJson(['message' => 'Berita updated successfully.']);
    }

    /**
     * Test untuk menghapus konten berita.
     */
    public function test_destroy_berita()
    {
        $content = Content::factory()->create();

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->deleteJson(route('konten.berita.destroy', $content->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('content', ['id' => $content->id]);
        $response->assertJson(['message' => 'Berita deleted successfully.']);
    }
}
