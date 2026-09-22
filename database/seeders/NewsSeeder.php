<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        if (News::query()->exists()) {
            return;
        }

        $items = [
            [
                'title' => 'Pembukaan Pendaftaran Haji Reguler 2026',
                'excerpt' => 'Informasi jadwal dan persyaratan pendaftaran haji bagi jamaah Kabupaten Purbalingga.',
                'content' => "Kantor Kementerian Haji dan Umrah Kabupaten Purbalingga menginformasikan pembukaan pendaftaran haji reguler.\n\nJamaah dapat melengkapi berkas sesuai ketentuan yang berlaku dan mengikuti arahan petugas di kantor. Untuk informasi lebih lanjut, silakan menghubungi kantor pada jam layanan atau melalui layanan konsultasi Mall Layanan.",
                'image' => 'images/news/news-1.png',
            ],
            [
                'title' => 'Sosialisasi Aplikasi Satu Haji',
                'excerpt' => 'Kegiatan sosialisasi penggunaan aplikasi Satu Haji bagi calon jamaah dan petugas.',
                'content' => "Dalam rangka meningkatkan layanan digital, kantor menyelenggarakan sosialisasi Aplikasi Satu Haji.\n\nAplikasi ini memudahkan jamaah memantau proses administrasi haji dan umrah secara daring. Unduh aplikasi melalui Google Play Store dan ikuti panduan yang disediakan.",
                'image' => 'images/news/news-2.jpeg',
            ],
            [
                'title' => 'Jadwal Konsultasi Layanan Haji Bulan Ini',
                'excerpt' => 'Jadwal konsultasi gratis terkait pendaftaran, pembatalan, dan pelimpahan kuota haji.',
                'content' => "Layanan konsultasi haji dibuka bagi masyarakat yang memerlukan penjelasan administrasi.\n\nSilakan datang langsung ke kantor dengan membawa dokumen pendukung atau menghubungi kontak resmi kantor. Petugas siap membantu proses layanan sesuai ketentuan Kementerian Agama.",
                'image' => 'images/news/news-3.JPG',
            ],
        ];

        foreach ($items as $item) {
            News::query()->create([
                ...$item,
                'slug' => News::uniqueSlug($item['title']),
                'published_at' => now()->subDays(rand(1, 14)),
                'is_published' => true,
            ]);
        }
    }
}
