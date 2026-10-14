<?php

namespace Tests\Feature;

use App\Models\Hajj2027Announcement;
use App\Models\Hajj2027Biometric;
use App\Models\Hajj2027District;
use App\Models\Hajj2027Document;
use App\Models\Hajj2027Kloter;
use App\Models\Hajj2027Service;
use App\Models\Hajj2027Stage;
use App\Models\Hajj2027Stat;
use App\Models\Hajj2027Timeline;
use App\Models\Hajj2027Verification;
use App\Models\News;
use App\Models\User;
use Database\Seeders\Hajj2027Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class Hajj2027Test extends TestCase
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

    public function test_public_info_jemaah_2027_page_renders_successfully(): void
    {
        $this->seed(Hajj2027Seeder::class);

        $response = $this->get('/info-jemaah-2027');

        $response->assertStatus(200);
        $response->assertSee('INFO JEMAAH HAJI PURBALINGGA 2027');
        $response->assertSee('1448 H / 2027 M');
        $response->assertSee('Pusat Informasi Persiapan Calon Jemaah Haji Kabupaten Purbalingga');
        $response->assertSee('Terakhir diperbarui:');
        $response->assertSee('Lihat Progres Persiapan');

        // Statistik
        $response->assertSee('375');
        $response->assertSee('Jumlah Calon Jemaah');
        $response->assertSee('18');
        $response->assertSee('Jumlah Kecamatan');

        // Biometrik
        $response->assertSee('PROGRES BIOMETRIK JEMAAH HAJI 2027');
        $response->assertSee('59.2%');

        // Progres Persiapan
        $response->assertSee('PROGRES PERSIAPAN HAJI 2027');
        $response->assertSee('Verifikasi Data');
        $response->assertSee('Biometrik');

        // Verifikasi
        $response->assertSee('REKAPITULASI VERIFIKASI CALON JEMAAH');
        $response->assertSee('Tahap I');

        // Kecamatan
        $response->assertSee('SEBARAN CALON JEMAAH HAJI PER KECAMATAN');
        $response->assertSee('Purbalingga');

        // Timeline
        $response->assertSee('TIMELINE PERSIAPAN JEMAAH HAJI 2027');

        // Kloter message
        $response->assertSee('Informasi kloter akan diperbarui setelah penetapan resmi');

        // Layanan Jemaah
        $response->assertSee('PRIORITAS LAYANAN JEMAAH');
        $response->assertSee('Layanan Khusus Jemaah Lansia');

        // Dokumen & Panduan
        $response->assertSee('PANDUAN & DOKUMEN JEMAAH', false);
    }

    public function test_guests_cannot_access_admin_hajj_2027_routes(): void
    {
        $response = $this->get('/admin/info-jemaah-2027');
        $response->assertRedirect('/admin/login');

        $responseStats = $this->get('/admin/info-jemaah-2027/statistik');
        $responseStats->assertRedirect('/admin/login');

        $responseStages = $this->get('/admin/info-jemaah-2027/progres');
        $responseStages->assertRedirect('/admin/login');
    }

    public function test_admin_can_view_info_jemaah_dashboard(): void
    {
        $admin = $this->createAdmin();
        $this->seed(Hajj2027Seeder::class);

        $response = $this->actingAs($admin)->get('/admin/info-jemaah-2027');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Info Jemaah 2027');
        $response->assertSee('Total Calon Jemaah');
        $response->assertSee('375');
    }

    public function test_admin_can_update_statistics(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->put('/admin/info-jemaah-2027/statistik', [
            'total_jemaah' => 400,
            'total_kecamatan' => 18,
            'jemaah_pria' => 180,
            'jemaah_wanita' => 220,
            'jemaah_lansia' => 50,
            'total_kloter' => 2,
            'keterangan' => 'Update resmi penetapan kuota definitif',
            'is_published' => true,
        ]);

        $response->assertRedirect(route('admin.jemaah-2027.stats.edit'));
        $this->assertDatabaseHas('hajj_2027_stats', [
            'total_jemaah' => 400,
            'jemaah_pria' => 180,
            'jemaah_wanita' => 220,
            'total_kloter' => 2,
        ]);
    }

    public function test_admin_can_create_update_delete_stage(): void
    {
        $admin = $this->createAdmin();

        // Create
        $response = $this->actingAs($admin)->post('/admin/info-jemaah-2027/progres', [
            'nama_tahapan' => 'Vaksinasi Meningitis & Polio',
            'persentase' => 10,
            'status' => 'Sedang Berlangsung',
            'keterangan' => 'Pelaksanaan vaksinasi di Puskesmas se-Purbalingga',
            'tanggal_update' => '2026-10-14',
            'urutan' => 9,
            'aktif' => true,
        ]);

        $response->assertRedirect(route('admin.jemaah-2027.stages.index'));
        $stage = Hajj2027Stage::query()->where('nama_tahapan', 'Vaksinasi Meningitis & Polio')->first();
        $this->assertNotNull($stage);
        $this->assertEquals(10, $stage->persentase);

        // Update
        $responseUpdate = $this->actingAs($admin)->put("/admin/info-jemaah-2027/progres/{$stage->id}", [
            'nama_tahapan' => 'Vaksinasi Meningitis & Polio',
            'persentase' => 95,
            'status' => 'Selesai',
            'keterangan' => 'Hampir seluruh jemaah telah divaksin',
            'tanggal_update' => '2026-10-14',
            'urutan' => 9,
            'aktif' => true,
        ]);

        $responseUpdate->assertRedirect(route('admin.jemaah-2027.stages.index'));
        $this->assertEquals(95, $stage->fresh()->persentase);
        $this->assertEquals('Selesai', $stage->fresh()->status);

        // Delete
        $responseDelete = $this->actingAs($admin)->delete("/admin/info-jemaah-2027/progres/{$stage->id}");
        $responseDelete->assertRedirect(route('admin.jemaah-2027.stages.index'));
        $this->assertDatabaseMissing('hajj_2027_stages', ['id' => $stage->id]);
    }

    public function test_biometrics_automatic_calculation(): void
    {
        $bio = new Hajj2027Biometric([
            'target' => 375,
            'sudah_biometrik' => 222,
        ]);

        $this->assertEquals(153, $bio->belum_biometrik);
        $this->assertEquals(59.2, $bio->persentase);
    }

    public function test_admin_can_update_biometrics(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->put('/admin/info-jemaah-2027/biometrik', [
            'target' => 400,
            'sudah_biometrik' => 300,
            'keterangan' => 'Perekaman tahap akhir',
            'tanggal_update' => '2026-10-14',
            'aktif' => true,
        ]);

        $response->assertRedirect(route('admin.jemaah-2027.biometrics.edit'));
        $this->assertDatabaseHas('hajj_2027_biometrics', [
            'target' => 400,
            'sudah_biometrik' => 300,
        ]);
    }

    public function test_admin_can_create_and_download_document(): void
    {
        $admin = $this->createAdmin();

        $file = UploadedFile::fake()->create('panduan-manasik-2027.pdf', 500, 'application/pdf');

        $response = $this->actingAs($admin)->post('/admin/info-jemaah-2027/dokumen', [
            'judul' => 'Panduan Manasik Terpadu 2027',
            'deskripsi' => 'Panduan pelaksanaan manasik tingkat KUA',
            'kategori' => 'Panduan',
            'tanggal' => '2026-10-14',
            'status' => 'Aktif',
            'urutan' => 1,
            'document_file' => $file,
        ]);

        $response->assertRedirect(route('admin.jemaah-2027.documents.index'));
        $doc = Hajj2027Document::query()->where('judul', 'Panduan Manasik Terpadu 2027')->first();
        $this->assertNotNull($doc);
        $this->assertFileExists(public_path($doc->file));

        // Public download
        $downloadResponse = $this->get("/info-jemaah-2027/dokumen/{$doc->id}/download");
        $downloadResponse->assertOk();
        $this->assertEquals(1, $doc->fresh()->download_count);

        // Cleanup
        if (file_exists(public_path($doc->file))) {
            @unlink(public_path($doc->file));
        }
    }
}
