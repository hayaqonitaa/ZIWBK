<?php

namespace Tests\Feature\konten;

use App\Models\User;
use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FeatureKontenLayananPengaduanTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        return User::factory()->create();
    }

    private function getCategory()
    {
        return ContentCategories::create([
            'id' => '8757bf6e-31a8-43a9-9d3f-90ed1030d62d',
            'nama' => 'Layanan Pengaduan',
        ]);
    }

    /**
     * Test untuk mendapatkan data konten layanan pengaduan dalam format JSON.
     */
    public function test_get_layanan_pengaduan()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $response = $this->actingAs($this->getUser())->getJson(route('konten.layanan_pengaduan.data'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'judul', 'deskripsi', 'file', 'status', 'id_kategori'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan data konten layanan pengaduan baru.
     */
    public function test_store_layanan_pengaduan()
    {
        $category = $this->getCategory();
        $file = UploadedFile::fake()->image('sample.jpg');
        $contentData = [
            'judul' => 'Layanan Pengaduan Baru',
            'deskripsi' => 'Deskripsi layanan pengaduan.',
            'file' => $file,
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.layanan_pengaduan.store'), $contentData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'judul' => 'Layanan Pengaduan Baru',
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
        Storage::disk('public')->assertExists('uploads/' . $file->hashName());
        $response->assertJson(['message' => 'Content created successfully.']);
    }

    /**
     * Test untuk memperbarui data konten layanan pengaduan.
     */
    public function test_update_layanan_pengaduan()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $updateData = [
            'judul' => 'Konten Baru',
            'deskripsi' => 'Deskripsi baru.',
            'status' => 'Tidak Aktif',
            'id_kategori' => $category->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.layanan_pengaduan.update', $content->id), $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'id' => $content->id,
            'judul' => 'Konten Baru',
            'status' => 'Tidak Aktif',
        ]);
        $response->assertJson(['message' => 'Content updated successfully.']);
    }

    /**
     * Test untuk menghapus konten layanan pengaduan.
     */
    public function test_destroy_layanan_pengaduan()
    {
        $content = Content::factory()->create();

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->deleteJson(route('konten.layanan_pengaduan.destroy', $content->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('content', ['id' => $content->id]);
        $response->assertJson(['message' => 'Content deleted successfully.']);
    }
}
