<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
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

    public function test_guest_is_redirected_when_accessing_admin_news(): void
    {
        $response = $this->get('/admin/berita');
        $response->assertRedirect('/admin/login');

        $responseCreate = $this->get('/admin/berita/create');
        $responseCreate->assertRedirect('/admin/login');
    }

    public function test_friendly_news_create_urls_redirect_cleanly_without_404(): void
    {
        $response1 = $this->get('/berita/create');
        $response1->assertRedirect(route('admin.berita.create'));

        $response2 = $this->get('/berita/tambah');
        $response2->assertRedirect(route('admin.berita.create'));

        $admin = $this->createAdmin();
        $response3 = $this->actingAs($admin)->get('/admin/berita/tambah');
        $response3->assertRedirect(route('admin.berita.create'));
    }

    public function test_admin_can_access_create_news_form_and_store_news(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->get('/admin/berita/create');
        $response->assertStatus(200);
        $response->assertSee('Tambah Berita');

        $storeResponse = $this->actingAs($admin)->post('/admin/berita', [
            'title' => 'Berita Pengumuman Haji Baru',
            'excerpt' => 'Ringkasan berita haji',
            'content' => 'Isi berita lengkap haji dan umrah.',
            'published_at' => now()->format('Y-m-d\TH:i'),
            'is_published' => '1',
        ]);

        $storeResponse->assertRedirect(route('admin.berita.index'));
        $storeResponse->assertSessionHas('success', 'Berita berhasil ditambahkan.');

        $this->assertDatabaseHas('news', [
            'title' => 'Berita Pengumuman Haji Baru',
            'is_published' => true,
        ]);
    }

    public function test_admin_can_preview_future_or_draft_news_without_404(): void
    {
        $admin = $this->createAdmin();

        $article = News::query()->create([
            'title' => 'Berita Terjadwal',
            'slug' => 'berita-terjadwal',
            'content' => 'Isi konten berita terjadwal.',
            'published_at' => now()->addHours(2), // Future date
            'is_published' => false, // Draft
        ]);

        // Guest cannot view draft/future news -> 404
        $guestResponse = $this->get('/berita/berita-terjadwal');
        $guestResponse->assertStatus(404);

        // Authenticated admin can view/preview it -> 200
        $adminResponse = $this->actingAs($admin)->get('/berita/berita-terjadwal');
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Berita Terjadwal');
    }

    public function test_public_can_view_published_news(): void
    {
        News::query()->create([
            'title' => 'Berita Resmi Publik',
            'slug' => 'berita-resmi-publik',
            'content' => 'Pengumuman resmi untuk jamaah.',
            'published_at' => now(),
            'is_published' => true,
        ]);

        $response = $this->get('/berita/berita-resmi-publik');
        $response->assertStatus(200);
        $response->assertSee('Berita Resmi Publik');
    }
}
