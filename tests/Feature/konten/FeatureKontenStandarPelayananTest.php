<?php

namespace Tests\Feature\konten;

use App\Models\User;
use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FeatureKontenStandarPelayananTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        return User::factory()->create();
    }

    private function getCategory()
    {
        return ContentCategories::create([
            'id' => 'c9669e93-de5a-4e43-8402-2bc4a0e202e3',
            'nama' => 'Standar Pelayanan',
        ]);
    }

    /**
     * Test untuk mendapatkan data konten standar pelayanan dalam format JSON.
     */
    public function test_get_standar_pelayanan()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $response = $this->actingAs($this->getUser())->getJson(route('konten.standar_pelayanan.data'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'judul', 'deskripsi', 'file', 'status', 'id_kategori'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan data konten standar pelayanan baru.
     */
    public function test_store_standar_pelayanan()
    {
        $category = $this->getCategory();
        $pdfFile = UploadedFile::fake()->create('sample.pdf', 1000);  // Simulasi file PDF
        $imageFile = UploadedFile::fake()->image('sample.jpg'); // Simulasi file gambar
        $contentData = [
            'judul' => 'Standar Pelayanan Baru',
            'pdf' => $pdfFile,
            'gambar' => $imageFile,
            'status' => 'Aktif',
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.standar_pelayanan.store'), $contentData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'judul' => 'Standar Pelayanan Baru',
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
        Storage::disk('public')->assertExists('uploads/' . $pdfFile->hashName());
        Storage::disk('public')->assertExists('uploads/' . $imageFile->hashName());
        $response->assertJson(['message' => 'Content created successfully.']);
    }

    /**
     * Test untuk memperbarui data konten standar pelayanan.
     */
    public function test_update_standar_pelayanan()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $updateData = [
            'judul' => 'Konten Standar Pelayanan Baru',
            'deskripsi' => 'Deskripsi standar pelayanan yang diperbarui.',
            'status' => 'Tidak Aktif',
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.standar_pelayanan.update', $content->id), $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'id' => $content->id,
            'judul' => 'Konten Standar Pelayanan Baru',
            'status' => 'Tidak Aktif',
        ]);
        $response->assertJson(['message' => 'Content updated successfully.']);
    }

    /**
     * Test untuk menghapus konten standar pelayanan.
     */
    public function test_destroy_standar_pelayanan()
    {
        $content = Content::factory()->create();

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->deleteJson(route('konten.standar_pelayanan.delete', $content->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('content', ['id' => $content->id]);
        $response->assertJson(['message' => 'Content deleted successfully.']);
    }
}
