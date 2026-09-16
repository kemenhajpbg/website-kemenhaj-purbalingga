<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::setMany([
            'site_title' => 'Kementerian Haji dan Umrah Kabupaten Purbalingga',
            'brand_line_1' => 'Kementerian Haji dan Umrah',
            'brand_line_2' => 'Kabupaten Purbalingga',
            'hero_title' => 'Sugeng Rawuh',
            'hero_subtitle' => "Layanan Digital Kantor Kementerian Haji dan Umrah\nKabupaten Purbalingga",
            'satuhaji_title' => 'APLIKASI SATUHAJI',
            'satuhaji_description' => 'Aplikasi layanan digital resmi Kementerian Agama Republik Indonesia untuk pengelolaan ibadah haji dan umrah. Tersedia di Google Play Store.',
            'satuhaji_button_text' => 'Klik disini',
            'satuhaji_button_url' => 'https://play.google.com/store/apps/details?id=com.kemenag_haji_pintar_2019&pcampaignid=web_share',
            'mall_title' => 'Mall Layanan',
            'cta_title_line1' => 'Cek Estimasi',
            'cta_title_line2' => 'Keberangkatan anda',
            'cta_button_text' => 'Klik disini',
            'cta_url' => 'https://haji.go.id/estimasi-keberangkatan',
            'contact_address' => 'Jl. DI Panjaitan No.15, Purbalingga Lor, Kec. Purbalingga, Kabupaten Purbalingga, Jawa Tengah 53311',
            'contact_email' => 'seksiphupbg@gmail.com',
            'contact_phone' => '0822-2502-0837',
            'contact_hours' => "Senin - Kamis : 08:00 - 15:00 WIB\nJumat : 08:00 - 15:30 WIB",
            'map_embed_url' => 'https://maps.google.com/maps?q=Kantor+Kementerian+Agama+Kabupaten+Purbalingga&t=&z=15&ie=UTF8&iwloc=&output=embed',
            'map_external_url' => 'https://maps.google.com/?q=Jl.+DI+Panjaitan+No.15,+Purbalingga',
            'map_button_text' => 'Lokasi',
            'image_logo_kemenhaj' => 'images/logo-kemenhaj.png',
            'image_hero_pejabat' => 'images/pejabat.png',
            'image_satuhaji' => 'images/satuhaji.png',
        ]);

        if (Service::query()->exists()) {
            return;
        }

        $services = [
            ['Pembatalan Karena Meninggal Dunia', 'https://drive.google.com/drive/folders/1M5cEVtenac9AbAq5RnABWsSO4tXOzgGL?usp=drive_link', 'images/icon1.png', 1],
            ['Pendaftaran', 'https://drive.google.com/drive/folders/1dCbO8QC7cry40xGklPcsvPY8vr4MXaVg?usp=sharing', 'images/icon2.png', 2],
            ['Pelimpahan Karena Meninggal Dunia', 'https://drive.google.com/drive/folders/1mTR6eLQpiXmySjUKjg0E4LxwL0IqJn3E?usp=sharing', 'images/icon3.png', 3],
            ['Pembatalan Karena Suatu Hal', 'https://drive.google.com/drive/folders/1dJZM4luaXBXyXep5OPPT8KOXJLfOjrWS?usp=drive_link', 'images/icon4.png', 4],
            ['Konsultasi', '#', 'images/icon5.png', 5],
            ['Pelimpahan Karena Suatu Hal', 'https://drive.google.com/drive/folders/1WVpCydxcRuGqAEVvS2hMesR7TNhFucwz?usp=drive_link', 'images/icon6.png', 6],
        ];

        foreach ($services as [$title, $url, $icon, $order]) {
            Service::query()->create([
                'title' => $title,
                'url' => $url,
                'icon' => $icon,
                'sort_order' => $order,
                'is_active' => true,
            ]);
        }
    }
}
