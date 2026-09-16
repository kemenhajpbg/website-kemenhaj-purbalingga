<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Gallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_gallery_page_is_accessible(): void
    {
        // Seed a gallery item
        Gallery::query()->create([
            'title' => 'Test Gallery Photo',
            'description' => 'Test description',
            'image' => 'images/gallery/test.png',
        ]);

        $response = $this->get('/galeri');

        $response->assertStatus(200);
        $response->assertSee('Test Gallery Photo');
        $response->assertSee('Galeri Kegiatan');
    }

    public function test_guest_cannot_access_admin_gallery_crud(): void
    {
        $response = $this->get('/admin/galeri');
        $response->assertRedirect('/admin/login');
    }

    public function test_authenticated_user_can_access_admin_gallery_crud(): void
    {
        $user = User::query()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.local',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($user)->get('/admin/galeri');

        $response->assertStatus(200);
        $response->assertSee('Kelola Galeri');
    }
}
