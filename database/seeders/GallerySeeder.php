<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        if (Gallery::query()->exists()) {
            return;
        }

        $items = [
            [
                'title' => 'Pelaksanaan Manasik Haji Tingkat Kabupaten',
                'description' => 'Kegiatan simulasi pelaksanaan ibadah haji (Manasik Haji) bersama calon jemaah haji Kabupaten Purbalingga di lapangan terbuka.',
                'image' => 'images/gallery/gallery-1-6a33514f6d5d4.jpeg',
            ],
            [
                'title' => 'Pemberangkatan Jemaah Haji Purbalingga',
                'description' => 'Suasana haru dan gembira mengiringi jemaah haji asal Kabupaten Purbalingga sebelum bertolak ke asrama haji.',
                'image' => 'images/gallery/gallery-2-6a335142dbe24.jpeg',
            ],
            [
                'title' => 'Bimbingan dan Sosialisasi Regulasi Haji',
                'description' => 'Kegiatan sosialisasi regulasi haji terbaru dan bimbingan administrasi oleh petugas Kementerian Agama di aula kantor.',
                'image' => 'images/gallery/gallery-3-6a335139d46a4.jpeg',
            ],
            [
                'title' => 'Dokumentasi Ibadah Haji di Tanah Suci',
                'description' => 'Jemaah haji Kabupaten Purbalingga melaksanakan rangkaian ibadah tawaf mengelilingi Ka\'bah di Masjidil Haram, Makkah.',
                'image' => 'images/gallery/gallery-4-6a33509b1ee01.jpeg',
            ],
        ];

        foreach ($items as $item) {
            Gallery::query()->create($item);
        }
    }
}
