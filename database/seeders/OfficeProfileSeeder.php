<?php

namespace Database\Seeders;

use App\Models\OfficeProfile;
use Illuminate\Database\Seeder;

class OfficeProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate/delete existing profile sections to start fresh
        OfficeProfile::query()->truncate();

        $sections = [
            [
                'title' => 'Struktur Organisasi',
                'content' => "Struktur organisasi Pelayanan Haji dan Umrah Kantor Kementerian Agama Kabupaten Purbalingga dirancang untuk menjamin efektivitas dan efisiensi alur birokrasi:\n\n- **Kepala Kantor Kemenag Purbalingga**: Pembina dan pengawas umum seluruh program pelayanan haji.\n- **Kasi Penyelenggaraan Haji & Umrah (PHU)**: Penanggung jawab operasional, perencanaan, koordinasi, dan pengawasan berkas haji.\n- **Staf Administrasi & Verifikasi**: Petugas pengolah data pendaftaran, perekaman foto/sidik jari jemaah, dan berkas pelimpahan/pembatalan.\n- **Tim Pendukung IT & Virtual Assistant**: Pengelola sistem informasi Siskohat, website portal informasi, dan layanan chatbot konsultasi online.",
                'video_url' => null,
                'image' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Sejarah Singkat',
                'content' => "Kantor Kementerian Haji dan Umrah Kabupaten Purbalingga berkomitmen memberikan pelayanan terbaik dalam menyelenggarakan urusan ibadah haji dan umrah bagi jemaah di wilayah Purbalingga. Sejak berdirinya, seksi Penyelenggaraan Haji dan Umrah (PHU) terus berinovasi untuk memberikan kepastian, keamanan, dan kenyamanan bagi calon jemaah haji.\n\nDengan didukung oleh sistem informasi terpadu dan staf yang berdedikasi, kami melayani ribuan pendaftar haji reguler setiap tahunnya, membimbing mereka mulai dari pendaftaran, manasik, pelunasan biaya, keberangkatan hingga pemulangan kembali ke tanah air.",
                'video_url' => 'https://www.youtube.com/embed/ZOrcZzBUxQI',
                'image' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Visi & Misi',
                'content' => "VISI:\nTerwujudnya pelayanan ibadah haji dan umrah yang profesional, amanah, akuntabel, dan terintegrasi secara digital demi kemudahan serta kemaslahatan seluruh jemaah di Kabupaten Purbalingga.\n\nMISI:\n1. Menyelenggarakan administrasi pendaftaran, pelimpahan porsi, dan pembatalan haji secara cepat, tepat, dan transparan.\n2. Menyediakan bimbingan dan penyuluhan manasik haji serta umrah secara berkala dan berkualitas.\n3. Mengembangkan sistem pelayanan digital terpadu untuk memudahkan jemaah dalam accessing informasi.\n4. Meningkatkan kualitas sarana, prasarana, dan sumber daya manusia guna menunjang pelayanan yang prima.",
                'video_url' => null,
                'image' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            OfficeProfile::query()->create($section);
        }
    }
}
