<?php

namespace Tests\Feature;

use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Pembagian;
use App\Models\Admin\Kuesioner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeaturePembagianTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menggunakan pengguna yang terautentikasi.
     *
     * @return void
     */
    private function getUser()
    {
        return \App\Models\User::factory()->create();
    }

    /**
     * Test untuk mendapatkan semua data pembagian.
     *
     * @return void
     */
    public function test_get_pembagian()
    {
        // Membuat data pembagian
        Pembagian::factory()->count(3)->create();

        $response = $this->actingAs($this->getUser())->getJson(route('pembagian.data'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'id_mahasiswa', 'id_kuesioner', 'status', 'created_at', 'updated_at'],
            ]
        ]);
    }

    /**
     * Test untuk membuat data pembagian baru.
     *
     * @return void
     */
    public function test_store_pembagian()
    {
        $mahasiswa = Mahasiswa::factory()->count(2)->create();
        $kuesioner = Kuesioner::factory()->create();

        $requestData = [
            'mahasiswa_ids' => $mahasiswa->pluck('id')->toArray(),
            'questionnaire_id' => $kuesioner->id,
        ];

        $response = $this->actingAs($this->getUser())->postJson(route('pembagian.share'), $requestData);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Kuesioner berhasil dipetakan!']);
        $this->assertDatabaseCount('pembagian', 2); // Memastikan 2 data pembagian dibuat
    }

    /**
     * Test untuk menghapus data pembagian.
     *
     * @return void
     */
    public function test_destroy_pembagian()
    {
        $pembagian = Pembagian::factory()->create();

        $response = $this->actingAs($this->getUser())
                         ->deleteJson(route('pembagian.destroy', $pembagian->id));

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Data Pembagian Kuesioner berhasil dihapus!']);
        $this->assertDatabaseMissing('pembagian', ['id' => $pembagian->id]);
    }

    /**
     * Test untuk mengirim email.
     *
     * @return void
     */
    public function test_kirim_email()
    {
        // Menggunakan ID statis untuk mahasiswa dan kuesioner
        $mahasiswaId = '9dabfb35-5ad4-422d-a48c-d2efe31116f1';
        $kuesionerId = '9dabfb45-d22c-4527-b3e8-2335fd4a2490';
    
        // Membuat pembagian dengan ID mahasiswa dan kuesioner yang telah ditentukan
        $pembagian = Pembagian::factory()->create([
            'id_mahasiswa' => $mahasiswaId,
            'id_kuesioner' => $kuesionerId,
        ]);
    
        // Melakukan pengujian dengan autentikasi pengguna
        $response = $this->actingAs($this->getUser())->postJson(route('pembagian.kirim'), [
            'ids' => [$pembagian->id], // Mengirim ID pembagian yang baru saja dibuat
        ]);
    
        // Memastikan respons berhasil
        $response->assertStatus(200); // Memastikan pengiriman email berhasil
        $response->assertJson(['success' => true]); // Memastikan respons sukses
    
        // Memastikan status pembagian berubah menjadi 'Sudah Terkirim'
        $pembagian->refresh(); // Segarkan data
        $this->assertEquals('Sudah Terkirim', $pembagian->status); // Verifikasi status berubah
    }
}
