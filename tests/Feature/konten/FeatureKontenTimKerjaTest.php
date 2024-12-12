<?php

namespace Tests\Feature\konten;

use App\Models\User;
use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FeatureKontenTimKerjaTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        return User::factory()->create();
    }

    private function getCategory()
    {
        return ContentCategories::create([
            'id' => '0bc353c5-e51a-400d-bc60-de775394ace2',
            'nama' => 'Tim Kerja',
        ]);
    }

    /**
     * Test untuk mendapatkan data konten tim kerja dalam format JSON.
     */
    public function test_get_tim_kerja()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $response = $this->actingAs($this->getUser())->getJson(route('konten.tim_kerja.data'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'judul', 'deskripsi', 'file', 'status', 'id_kategori'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan data konten tim kerja baru.
     */
    public function test_store_tim_kerja()
    {
        $category = $this->getCategory();
        $file = UploadedFile::fake()->create('sample.pdf', 500, 'application/pdf');
        $contentData = [
            'judul' => 'Tim Kerja Baru',
            'deskripsi' => 'Deskripsi tim kerja baru.',
            'file' => $file,
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.tim_kerja.store'), $contentData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'judul' => 'Tim Kerja Baru',
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
        Storage::disk('public')->assertExists('uploads/' . $file->hashName());
        $response->assertJson(['message' => 'Content created successfully.']);
    }

    /**
     * Test untuk memperbarui data konten tim kerja.
     */
    public function test_update_tim_kerja()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $updateData = [
            'judul' => 'Tim Kerja Diperbarui',
            'deskripsi' => 'Deskripsi tim kerja diperbarui.',
            'status' => 'Tidak Aktif',
            'id_kategori' => $category->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.tim_kerja.update', $content->id), $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'id' => $content->id,
            'judul' => 'Tim Kerja Diperbarui',
            'status' => 'Tidak Aktif',
        ]);
        $response->assertJson(['message' => 'Content updated successfully.']);
    }

    /**
     * Test untuk menghapus konten tim kerja.
     */
    public function test_destroy_tim_kerja()
    {
        $content = Content::factory()->create();

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->deleteJson(route('konten.tim_kerja.destroy', $content->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('content', ['id' => $content->id]);
        $response->assertJson(['message' => 'Content deleted successfully.']);
    }
}
