<?php
namespace Tests\Feature\user_page;

use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PiagamBeritaTest extends TestCase
{
    use RefreshDatabase;

    private function getCategoryPiagam()
    {
        return ContentCategories::create([
            'id' => '8101bdbf-d3a4-4859-9691-95fa7a9c8e88',
            'nama' => 'Piagam',
        ]);
    }

    private function getCategoryBerita()
    {
        return ContentCategories::create([
            'id' => '6d147c7e-1185-4453-87b7-edfe86ee66bc',
            'nama' => 'Berita',
        ]);
    }

    private function getContentPiagam()
    {
        $category = $this->getCategoryPiagam();

        return Content::factory()->create([
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
    }

    private function getContentBerita()
    {
        $category = $this->getCategoryBerita();

        return Content::factory()->create([
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
    }

    /**
     * Test untuk memastikan controller mengembalikan data Piagam dan Berita yang tepat.
     */
    public function test_index_piagam_berita()
    {
        // Menyiapkan data
        $piagamContent = $this->getContentPiagam();
        $beritaContent = $this->getContentBerita();

        // Mengakses halaman index
        $response = $this->get(route('home'));

        // Memastikan response sukses (status 200)
        $response->assertStatus(200);

        // Memastikan bahwa data Piagam dan Berita yang tepat dikirim ke tampilan
        $response->assertViewHas('piagamContents', function ($contents) use ($piagamContent) {
            return $contents->contains('id', $piagamContent->id) && $contents->contains('status', 'Aktif');
        });

        $response->assertViewHas('beritaContents', function ($contents) use ($beritaContent) {
            return $contents->contains('id', $beritaContent->id) && $contents->contains('status', 'Aktif');
        });

        // Memastikan bahwa pageConfigs juga dikirim ke tampilan
        $response->assertViewHas('pageConfigs', ['myLayout' => 'front']);
    }

    /**
     * Test untuk memastikan menampilkan data berita berdasarkan id.
     */
    public function test_show_berita()
    {
        $beritaContent = $this->getContentBerita();

        $response = $this->get(route('berita.show', $beritaContent->id));

        $response->assertStatus(200);
        $response->assertViewHas('berita', function ($berita) use ($beritaContent) {
            return $berita->id === $beritaContent->id;
        });
    }
}
