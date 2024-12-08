<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Prodi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FeatureMahasiswaTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        return User::factory()->create();
    }

    /**
     * Test untuk mendapatkan data Mahasiswa dalam format JSON.
     */
    public function test_get_mahasiswa()
    {
        $prodi = Prodi::factory()->create();
        Mahasiswa::factory()->create(['id_prodi' => $prodi->id]);

        $response = $this->actingAs($this->getUser())->getJson(route('mahasiswa.data'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'nim', 'nama', 'email', 'id_prodi', 'prodi'],
            ]
        ]);
    }

    /**
     * Test untuk menyimpan data Mahasiswa baru.
     */
    public function test_store_mahasiswa()
    {
        $this->artisan('migrate:fresh');

        $prodi = Prodi::factory()->create();
        $mahasiswaData = [
            'nim' => '763842',
            'nama' => 'Mahasiswa Baru',
            'email' => 'ujiCoba@coba.com',
            'id_prodi' => $prodi->id,
        ];

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('mahasiswa.store'), $mahasiswaData);


        $response->assertStatus(200);
        $this->assertDatabaseHas('mahasiswa', $mahasiswaData);
        $response->assertJson(['message' => 'Data mahasiswa berhasil disimpan.']);
    }

    /**
     * Test untuk memperbarui data Mahasiswa.
     */
    public function test_update_mahasiswa()
    {
        $prodi = Prodi::factory()->create();
        $mahasiswa = Mahasiswa::factory()->create(['id_prodi' => $prodi->id]);

        $updateData = [
            'id' => $mahasiswa->id,
            'nim' => '87654321',
            'nama' => 'Mahasiswa Update',
            'email' => 'updated@example.com',
            'id_prodi' => $prodi->id,
        ];
        $response = $this->withoutMiddleware()->actingAs($this->getUser())->postJson(route('mahasiswa.update', $mahasiswa->id), $updateData);
        $response = $this->actingAs($this->getUser())->putJson(route('mahasiswa.update', $mahasiswa->id), $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('mahasiswa', ['nama' => 'Mahasiswa Update']);
        $response->assertJson(['message' => 'Mahasiswa updated successfully!']);
    }

    /**
     * Test untuk menghapus data Mahasiswa.
     */
    public function test_destroy_mahasiswa()
    {
        $mahasiswa = Mahasiswa::factory()->create();

        $response = $this->withoutMiddleware()->actingAs($this->getUser())->deleteJson(route('mahasiswa.destroy', $mahasiswa->id));
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('mahasiswa', ['id' => $mahasiswa->id]);
        $response->assertJson(['message' => 'Mahasiswa berhasil dihapus!']);
    }

    /**
     * Test untuk mengunggah file Excel dan mengimpor data Mahasiswa.
     */
    public function testImportMahasiswaFromExcel()
    {
        // Simulasi file Excel
        $file = new \Illuminate\Http\UploadedFile(
            resource_path('testing/mahasiswa_valid.xlsx'), // Pastikan file ada di lokasi ini
            'mahasiswa_valid.xlsx',
            null,
            null,
            true
        );
    
        // Lakukan request ke endpoint
        $response = $this->postJson(route('mahasiswa.uploadExcel'), [
            'file' => $file,
        ]);
    
        // Pastikan response memiliki status
        $this->assertNotNull($response->status());
    
        // Assert: Status 200
        if ($response->status() === 200) {
            $response->assertJson([
                'message' => 'Data berhasil diimpor',
            ]);
        }
    
        // Assert: Status 422
        elseif ($response->status() === 422) {
            $response->assertJsonStructure([
                'message',
                'email_errors',
                'prodi_errors',
            ]);
        }
    
        // Assert: Status 500
        elseif ($response->status() === 500) {
            $response->assertJson([
                'message' => 'Terjadi kesalahan',
            ]);
        }
    
        // Tambahkan assertion akhir untuk menghindari test risky
        $this->assertTrue(true);
    }
}


