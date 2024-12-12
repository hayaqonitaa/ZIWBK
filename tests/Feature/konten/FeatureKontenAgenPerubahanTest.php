<?php

namespace Tests\Feature\konten;

use App\Models\User;
use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FeatureKontenAgenPerubahanTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        return User::factory()->create();
    }

    private function getCategory()
    {
        return ContentCategories::create([
            'id' => '71feeff3-55e4-41cd-866d-d8bedc3116fd',
            'nama' => 'Agen Perubahan',
        ]);
    }

    /**
     * Test untuk mendapatkan data Agen Perubahan dalam format JSON.
     */
    public function test_get_agen_perubahan()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $response = $this->actingAs($this->getUser())->getJson(route('konten.agen_perubahan.data'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => ['id', 'judul', 'deskripsi', 'file', 'status', 'id_kategori', 'id_admin'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan data Agen Perubahan baru.
     */
    public function test_store_agen_perubahan()
    {
        $category = $this->getCategory();
        $file = UploadedFile::fake()->image('agen_perubahan.jpg');
        $contentData = [
            'judul' => 'Agen Perubahan Baru',
            'deskripsi' => 'Deskripsi agen perubahan baru.',
            'file' => $file,
            'status' => 'Aktif',
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.agen_perubahan.store'), $contentData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'judul' => 'Agen Perubahan Baru',
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
        Storage::disk('public')->assertExists('uploads/' . $file->hashName());
        $response->assertJson(['message' => 'Content created successfully.']);
    }

    /**
     * Test untuk memperbarui data Agen Perubahan.
     */
    public function test_update_agen_perubahan()
    {
        $category = $this->getCategory();
        $content = Content::factory()->create(['id_kategori' => $category->id]);

        $updateData = [
            'judul' => 'Agen Perubahan Diperbarui',
            'deskripsi' => 'Deskripsi agen perubahan diperbarui.',
            'status' => 'Tidak Aktif',
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('konten.agen_perubahan.update', $content->id), $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('content', [
            'id' => $content->id,
            'judul' => 'Agen Perubahan Diperbarui',
            'status' => 'Tidak Aktif',
        ]);
        $response->assertJson(['message' => 'Content updated successfully.']);
    }

    /**
     * Test untuk menghapus data Agen Perubahan.
     */
    public function test_destroy_agen_perubahan()
    {
        $content = Content::factory()->create();

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->deleteJson(route('konten.agen_perubahan.destroy', $content->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('content', ['id' => $content->id]);
        $response->assertJson(['message' => 'Content deleted successfully.']);
    }
}
