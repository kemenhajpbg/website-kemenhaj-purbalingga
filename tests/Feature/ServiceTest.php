<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        return User::query()->create([
            'name' => 'Admin Tester',
            'email' => 'admin@kemenhaj.local',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_guest_cannot_access_services_admin(): void
    {
        $response = $this->get('/admin/layanan');
        $response->assertRedirect('/admin/login');

        $responseCreate = $this->get('/admin/layanan/create');
        $responseCreate->assertRedirect('/admin/login');
    }

    public function test_admin_can_view_services_index(): void
    {
        $admin = $this->createAdmin();

        Service::query()->create([
            'title' => 'Layanan Konsultasi Haji',
            'url' => 'https://example.com/haji',
            'icon' => 'images/icon1.png',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin/layanan');
        $response->assertStatus(200);
        $response->assertSee('Mall Layanan');
        $response->assertSee('Layanan Konsultasi Haji');
    }

    public function test_admin_can_create_service_without_server_error(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->post('/admin/layanan', [
            'title' => 'Layanan Pendaftaran Baru',
            'url' => 'https://example.com/daftar',
            'sort_order' => 1,
            'is_active' => 1,
        ]);

        // Verifies redirect works properly and no RouteNotFoundException occurs
        $response->assertRedirect(route('admin.layanan.index'));
        $response->assertSessionHas('success', 'Layanan berhasil ditambahkan.');

        $this->assertDatabaseHas('services', [
            'title' => 'Layanan Pendaftaran Baru',
            'url' => 'https://example.com/daftar',
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_service(): void
    {
        $admin = $this->createAdmin();

        $service = Service::query()->create([
            'title' => 'Layanan Lama',
            'url' => 'https://example.com/lama',
            'icon' => 'images/icon1.png',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->put('/admin/layanan/'.$service->id, [
            'title' => 'Layanan Diperbarui',
            'url' => 'https://example.com/baru',
            'sort_order' => 2,
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.layanan.index'));
        $response->assertSessionHas('success', 'Layanan berhasil diperbarui.');

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'Layanan Diperbarui',
            'sort_order' => 2,
        ]);
    }

    public function test_admin_can_delete_service(): void
    {
        $admin = $this->createAdmin();

        $service = Service::query()->create([
            'title' => 'Layanan Dihapus',
            'url' => 'https://example.com/hapus',
            'icon' => 'images/icon1.png',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->delete('/admin/layanan/'.$service->id);

        $response->assertRedirect(route('admin.layanan.index'));
        $response->assertSessionHas('success', 'Layanan berhasil dihapus.');

        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }
}
