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

        $response->assertRedirect(route('admin.layanan.index'));
        $response->assertSessionHas('success', 'Tautan layanan berhasil ditambahkan.');

        $this->assertDatabaseHas('services', [
            'title' => 'Layanan Pendaftaran Baru',
            'url' => 'https://example.com/daftar',
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_create_service_page_with_hajj_statistics_and_pdf_document(): void
    {
        $admin = $this->createAdmin();

        $pdf = UploadedFile::fake()->create('dokumen_verifikasi.pdf', 500, 'application/pdf');

        $districtInputs = [];
        foreach (Service::PURBALINGGA_DISTRICTS as $district) {
            $districtInputs[$district] = 10;
        }

        $response = $this->actingAs($admin)->post('/admin/layanan', [
            'type' => 'page',
            'title' => 'Verifikasi Jemaah Haji 2026',
            'slug' => 'verifikasi-jemaah-haji-2026',
            'description' => 'Data jemaah haji yang siap diberangkatkan tahun ini.',
            'sort_order' => 1,
            'is_active' => 1,
            'total_verified' => 350,
            'ready_count' => 310,
            'delayed_count' => 20,
            'deceased_count' => 10,
            'under_18_count' => 5,
            'transfer_count' => 5,
            'districts' => $districtInputs,
            'document_file' => $pdf,
            'document_name' => 'SK Verifikasi Keberangkatan Haji',
        ]);

        $response->assertRedirect(route('admin.layanan.index'));
        $response->assertSessionHas('success', 'Halaman layanan berhasil ditambahkan ke Mall Layanan.');

        $this->assertDatabaseHas('services', [
            'type' => 'page',
            'title' => 'Verifikasi Jemaah Haji 2026',
            'slug' => 'verifikasi-jemaah-haji-2026',
            'total_verified' => 350,
            'ready_count' => 310,
            'delayed_count' => 20,
            'deceased_count' => 10,
            'under_18_count' => 5,
            'transfer_count' => 5,
            'document_name' => 'SK Verifikasi Keberangkatan Haji',
        ]);

        $service = Service::query()->where('slug', 'verifikasi-jemaah-haji-2026')->first();
        $this->assertNotNull($service);
        $this->assertNotNull($service->document_path);
        $this->assertTrue(file_exists(public_path($service->document_path)));

        // Clean up uploaded test file
        @unlink(public_path($service->document_path));
    }

    public function test_public_user_can_view_service_page_with_metrics_districts_and_pdf(): void
    {
        $districtCounts = [];
        foreach (Service::PURBALINGGA_DISTRICTS as $district) {
            $districtCounts[$district] = 15;
        }

        $service = Service::query()->create([
            'type' => 'page',
            'title' => 'Data Verifikasi Jemaah Haji',
            'slug' => 'data-verifikasi-jemaah',
            'description' => 'Rekap data calon jemaah haji Kabupaten Purbalingga.',
            'icon' => 'images/icon2.png',
            'sort_order' => 1,
            'is_active' => true,
            'total_verified' => 270,
            'ready_count' => 250,
            'delayed_count' => 10,
            'deceased_count' => 5,
            'under_18_count' => 2,
            'transfer_count' => 3,
            'district_counts' => $districtCounts,
            'document_path' => 'documents/services/dummy.pdf',
            'document_name' => 'Surat Keputusan Verifikasi.pdf',
            'document_size' => '1.5 MB',
        ]);

        $response = $this->get('/layanan/'.$service->slug);
        $response->assertStatus(200);
        $response->assertSee('Data Verifikasi Jemaah Haji');
        $response->assertSee('Rekap data calon jemaah haji Kabupaten Purbalingga.');
        $response->assertSee('270'); // Total verifikasi
        $response->assertSee('250'); // Siap berangkat
        $response->assertSee('Surat Keputusan Verifikasi.pdf');
        $response->assertSee('Bobotsari');
        $response->assertSee('Purbalingga');
        $response->assertSee('Kemangkon');
    }

    public function test_home_page_displays_mall_layanan_button_linking_to_service_page(): void
    {
        $service = Service::query()->create([
            'type' => 'page',
            'title' => 'Halaman Jemaah Berangkat',
            'slug' => 'jemaah-berangkat',
            'icon' => 'images/icon1.png',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Halaman Jemaah Berangkat');
        $response->assertSee(route('layanan.show', 'jemaah-berangkat'));
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
