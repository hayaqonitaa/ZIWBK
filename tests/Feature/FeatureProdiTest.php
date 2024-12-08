<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Admin\Prodi;
use App\Models\Admin\Jurusan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureProdiTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        return User::factory()->create();
    }


    /**
     * Test untuk mendapatkan data Prodi dalam format JSON.
     */
    public function test_get_prodi()
    {
        $jurusan = Jurusan::factory()->create();
        Prodi::factory()->create(['id_jurusan' => $jurusan->id]);

        $response = $this->actingAs($this->getUser())->getJson(route('prodi.data'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'nama', 'id_jurusan', 'jurusan'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan data Prodi baru.
     */
    public function test_store_prodi()
    {
        $jurusan = Jurusan::factory()->create();
        $prodiData = [
            'nama' => 'Teknik Elektro',
            'id_jurusan' => $jurusan->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('prodi.store'), $prodiData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('prodi', $prodiData);
        $response->assertJson(['message' => 'Prodi berhasil ditambahkan!']);
    }

    /**
     * Test untuk memperbarui data Prodi.
     */
    public function test_update_prodi()
    {
        $jurusan = Jurusan::factory()->create();
        $prodi = Prodi::factory()->create(['id_jurusan' => $jurusan->id]);

        $updateData = [
            'id' => $prodi->id,
            'nama' => 'Teknik Mesin',
            'id_jurusan' => $jurusan->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->putJson(route('prodi.update', $prodi->id), $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('prodi', ['nama' => 'Teknik Mesin']);
        $response->assertJson(['message' => 'Prodi updated successfully!']);
    }

    /**
     * Test untuk menghapus data Prodi.
     */
    public function test_destroy_prodi()
    {
        $prodi = Prodi::factory()->create();

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->deleteJson(route('prodi.destroy', $prodi->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('prodi', ['id' => $prodi->id]);
        $response->assertJson(['message' => 'Prodi berhasil dihapus!']);
    }
}
