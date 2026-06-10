<?php

namespace Database\Seeders;

use App\Models\HajjStat;
use Illuminate\Database\Seeder;

class HajjStatSeeder extends Seeder
{
    public function run(): void
    {
        if (HajjStat::query()->exists()) {
            return;
        }

        $defaults = HajjStat::defaults();

        HajjStat::query()->create([
            'data_date' => now()->toDateString(),
            'elderly_count' => 142,
            'waiting_period' => '8 Tahun 4 Bulan',
            'total_registrants' => 1847,
            'monthly_registrants' => array_merge($defaults['monthly_registrants'], [
                'Januari' => 45, 'Februari' => 62, 'Maret' => 88, 'April' => 120,
                'Mei' => 156, 'Juni' => 134, 'Juli' => 98, 'Agustus' => 76,
                'September' => 54, 'Oktober' => 41, 'November' => 38, 'Desember' => 35,
            ]),
            'gender' => ['Laki-laki' => 892, 'Perempuan' => 955],
            'occupation' => [
                'BUMN/BUMD' => 124, 'Dagang' => 186, 'IRT' => 312, 'Pelajar/Mahasiswa' => 45,
                'PNS' => 278, 'TNI/Polri' => 34, 'Pensiunan' => 198, 'Swasta' => 412,
                'Petani' => 156, 'Lain-Lain' => 102,
            ],
            'education' => [
                'SD' => 89, 'SMP' => 156, 'SMA' => 534, 'S1' => 687,
                'S2' => 245, 'S3' => 42, 'Lain-Lain' => 94,
            ],
            'age' => [
                '12-20' => 28, '21-30' => 156, '31-40' => 312, '51-60' => 445,
                '61-70' => 534, '71-80' => 298, '81-90' => 74,
            ],
            'is_published' => true,
        ]);
    }
}
