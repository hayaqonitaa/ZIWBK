<?php

namespace Tests\Unit;

use App\Http\Controllers\admin_page\JurusanController;
use App\Models\Admin\Jurusan;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Models\User;  // Pastikan User diimpor

class JurusanControllerTest extends TestCase
{
    public function test_store_jurusan()
    {
        // Menggunakan factory untuk membuat data jurusan
        $jurusan = Jurusan::factory()->make(); // Membuat data tapi tidak disimpan di database

        // Simulasi request
        $request = Request::create('/jurusan/store', 'POST', ['nama' => $jurusan->nama]);

        // Validasi bahwa data bisa disimpan dengan benar
        $controller = new JurusanController();
        $response = $controller->store($request);

        // Memastikan bahwa data jurusan tersimpan di database
        $this->assertDatabaseHas('jurusan', ['nama' => $jurusan->nama]);
    }

    public function test_update_jurusan()
    {
        $user = User::factory()->create();
        $jurusan = Jurusan::factory()->create();
        $newName = 'Teknik Mesin';
        
        // Simulasi autentikasi
        $this->actingAs($user);

        $this->withoutMiddleware();
    
        // Mengirimkan ID dan data baru untuk diupdate
        $response = $this->put(route('jurusan.update', ['id' => $jurusan->id]), ['nama' => $newName]);
    
        // Memastikan respons berhasil
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Jurusan updated successfully!']);
    
        // Memastikan data jurusan diperbarui di database
        $jurusan->refresh();
        $this->assertEquals($newName, $jurusan->nama);
    }
    

    public function test_destroy_jurusan()
    {
        $user = User::factory()->create();
        $jurusan = Jurusan::factory()->create();
        
        // Simulasi autentikasi
        $this->actingAs($user);
    
        // Mengirimkan request untuk menghapus jurusan
        $response = $this->delete(route('jurusan.destroy', ['id' => $jurusan->id]));
    
        // Memastikan respons berhasil
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Jurusan berhasil dihapus!']);
    
        // Memastikan data jurusan sudah dihapus dari database
        $this->assertDatabaseMissing('jurusan', ['id' => $jurusan->id]);
    }
    
    
    public function test_get_jurusan()
    {
        // Membuat pengguna untuk autentikasi
        $user = User::factory()->create();
    
        // Membuat data jurusan
        $jurusan = Jurusan::factory()->create();
    
        // Simulasi autentikasi
        $this->actingAs($user);
    
        // Membuat request untuk mengambil data jurusan
        $response = $this->get(route('admin-page.jurusan.jurusan'));
    
        // Memastikan respons berhasil
        $response->assertStatus(200)
                 ->assertJsonStructure(['data' => [['id', 'nama']]]);
    }
    
}
