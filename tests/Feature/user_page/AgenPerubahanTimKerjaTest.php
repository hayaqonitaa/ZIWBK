<?php

namespace Tests\Feature\user_page;

use App\Models\Content;
use App\Models\ContentCategories;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgenPerubahanTimKerjaTest extends TestCase
{
    use RefreshDatabase;

    private function getCategoryAgenPerubahan()
    {
        return ContentCategories::create([
            'id' => '71feeff3-55e4-41cd-866d-d8bedc3116fd',
            'nama' => 'Agen Perubahan',
        ]);
    }

    private function getCategoryTimKerja()
    {
        return ContentCategories::create([
            'id' => '0bc353c5-e51a-400d-bc60-de775394ace2',
            'nama' => 'Tim Kerja',
        ]);
    }

    private function getContentAgenPerubahan()
    {
        $category = $this->getCategoryAgenPerubahan();

        return Content::factory()->create([
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
    }

    private function getContentTimKerja()
    {
        $category = $this->getCategoryTimKerja();

        return Content::factory()->create([
            'status' => 'Aktif',
            'id_kategori' => $category->id,
        ]);
    }

    /**
     * Test untuk memastikan controller mengembalikan data Agen Perubahan dan Tim Kerja yang tepat.
     */
    public function test_index_agen_perubahan_tim_kerja()
    {
        // Menyiapkan data
        $agenPerubahanContent = $this->getContentAgenPerubahan();
        $timKerjaContent = $this->getContentTimKerja();

        // Mengakses halaman index
        $response = $this->get(route('tim'));

        // Memastikan response sukses (status 200)
        $response->assertStatus(200);

        // Memastikan bahwa data Agen Perubahan dan Tim Kerja yang tepat dikirim ke tampilan
        $response->assertViewHas('agenPerubahanContents', function ($contents) use ($agenPerubahanContent) {
            return $contents->contains('id', $agenPerubahanContent->id) && $contents->contains('status', 'Aktif');
        });

        $response->assertViewHas('timKerjaContents', function ($contents) use ($timKerjaContent) {
            return $contents->contains('id', $timKerjaContent->id) && $contents->contains('status', 'Aktif');
        });

        // Memastikan bahwa pageConfigs juga dikirim ke tampilan
        $response->assertViewHas('pageConfigs', ['myLayout' => 'front']);
    }
}
