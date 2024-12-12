<?php

namespace Tests\Feature\user_page;

use App\Models\Content;
use App\Models\ContentCategories;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayananPengaduanTest extends TestCase
{
    use RefreshDatabase;

    private function getCategory()
    {
        return ContentCategories::create([
            'id' => '8757bf6e-31a8-43a9-9d3f-90ed1030d62d',
            'nama' => 'Layanan Pengaduan',
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
    public function test_index_layanan_pengaduan()
    {
        // Menyiapkan data
        $content = $this->getContent();

        // Mengakses halaman index
        $response = $this->get(route('layanan-pengaduan'));

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
