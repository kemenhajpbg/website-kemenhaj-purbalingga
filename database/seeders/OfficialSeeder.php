<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate/delete existing officials to start fresh
        Official::query()->truncate();

        $officials = [
            [
                'name' => 'Mochamad Irfan Yusuf',
                'position' => 'Menteri Haji dan Umrah Republik Indonesia',
                'image' => 'images/officials/official-1.png',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Dahnil Anzar Simanjuntak',
                'position' => 'Wakil Menteri Haji dan Umrah Republik Indonesia',
                'image' => 'images/officials/official-2.png',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Teguh Dwi Nugroho',
                'position' => 'Sekretaris Jenderal Kementerian Haji dan Umrah RI',
                'image' => 'images/officials/official-3.png',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($officials as $official) {
            Official::query()->create($official);
        }
    }
}
