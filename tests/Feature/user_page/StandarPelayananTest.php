<?php

namespace Tests\Feature\user_page;

use Tests\TestCase;
use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StandarPelayananTest extends TestCase
{
    use RefreshDatabase;

    private function getCategory()
    {
        return ContentCategories::create([
            'id' => 'c9669e93-de5a-4e43-8402-2bc4a0e202e3',
            'nama' => 'Standar Pelayanan',
        ]);
    }

    private function getContent()
    {
        $category = $this->getCategory();

        return Content::factory()->create([
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
    }

    /**
     * Test untuk memastikan controller mengembalikan data konten dengan kategori dan status yang tepat.
     */
    public function test_index_standar_pelayanan()
    {
        // Menyiapkan data
        $content = $this->getContent();

        // Mengakses halaman index
        $response = $this->get(route('standar-pelayanan'));

        // Memastikan response sukses (status 200)
        $response->assertStatus(200);

        // Memastikan bahwa data konten yang tepat dikirim ke tampilan
        $response->assertViewHas('contents', function ($contents) use ($content) {
            return $contents->contains('id', $content->id) && $contents->contains('status', 'Aktif');
        });

        // Memastikan bahwa pageConfigs juga dikirim ke tampilan
        $response->assertViewHas('pageConfigs', ['myLayout' => 'front']);
    }
}