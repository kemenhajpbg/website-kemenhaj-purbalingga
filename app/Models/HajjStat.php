<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HajjStat extends Model
{
    public const MONTHS = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
    ];

    public const GENDERS = ['Laki-laki', 'Perempuan'];

    public const OCCUPATIONS = [
        'BUMN/BUMD', 'Dagang', 'IRT', 'Pelajar/Mahasiswa', 'PNS',
        'TNI/Polri', 'Pensiunan', 'Swasta', 'Petani', 'Lain-Lain',
    ];

    public const EDUCATIONS = ['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3', 'Lain-Lain'];

    public const AGE_GROUPS = ['12-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71-80', '81-90'];

    protected $fillable = [
        'data_date',
        'elderly_count',
        'waiting_period',
        'total_registrants',
        'monthly_registrants',
        'gender',
        'occupation',
        'education',
        'age',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'data_date' => 'date',
            'monthly_registrants' => 'array',
            'gender' => 'array',
            'occupation' => 'array',
            'education' => 'array',
            'age' => 'array',
            'is_published' => 'boolean',
        ];
    }

    public static function defaults(): array
    {
        return [
            'monthly_registrants' => array_fill_keys(self::MONTHS, 0),
            'gender' => array_fill_keys(self::GENDERS, 0),
            'occupation' => array_fill_keys(self::OCCUPATIONS, 0),
            'education' => array_fill_keys(self::EDUCATIONS, 0),
            'age' => array_fill_keys(self::AGE_GROUPS, 0),
        ];
    }

    public static function latestPublished(): ?self
    {
        return static::query()
            ->where('is_published', true)
            ->orderByDesc('data_date')
            ->orderByDesc('id')
            ->first();
    }

    public function chartPayload(): array
    {
        return [
            'monthly' => [
                'labels' => self::MONTHS,
                'values' => array_map(fn ($m) => (int) ($this->monthly_registrants[$m] ?? 0), self::MONTHS),
            ],
            'gender' => [
                'labels' => self::GENDERS,
                'values' => array_map(fn ($g) => (int) ($this->gender[$g] ?? 0), self::GENDERS),
            ],
            'occupation' => [
                'labels' => self::OCCUPATIONS,
                'values' => array_map(fn ($o) => (int) ($this->occupation[$o] ?? 0), self::OCCUPATIONS),
            ],
            'education' => [
                'labels' => self::EDUCATIONS,
                'values' => array_map(fn ($e) => (int) ($this->education[$e] ?? 0), self::EDUCATIONS),
            ],
            'age' => [
                'labels' => self::AGE_GROUPS,
                'values' => array_map(fn ($a) => (int) ($this->age[$a] ?? 0), self::AGE_GROUPS),
            ],
        ];
    }
}
