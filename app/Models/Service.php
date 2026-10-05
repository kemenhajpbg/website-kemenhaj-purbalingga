<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    public const PURBALINGGA_DISTRICTS = [
        'Bobotsari',
        'Bojongsari',
        'Bukateja',
        'Kaligondang',
        'Kalimanah',
        'Karanganyar',
        'Karangjambu',
        'Karangmoncol',
        'Karangreja',
        'Kejobong',
        'Kemangkon',
        'Kertanegara',
        'Kutasari',
        'Mrebet',
        'Padamara',
        'Pengadegan',
        'Purbalingga',
        'Rembang',
    ];

    protected $fillable = [
        'type',
        'title',
        'slug',
        'description',
        'url',
        'icon',
        'sort_order',
        'is_active',
        'total_verified',
        'ready_count',
        'delayed_count',
        'deceased_count',
        'under_18_count',
        'transfer_count',
        'district_counts',
        'document_path',
        'document_name',
        'document_size',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'total_verified' => 'integer',
            'ready_count' => 'integer',
            'delayed_count' => 'integer',
            'deceased_count' => 'integer',
            'under_18_count' => 'integer',
            'transfer_count' => 'integer',
            'district_counts' => 'array',
        ];
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug ?: 'halaman';
        $count = 1;

        while (static::query()
            ->when($ignoreId, fn (Builder $q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original.'-'.$count++;
        }

        return $slug;
    }

    public function isPage(): bool
    {
        return $this->type === 'page';
    }

    public function isExternal(): bool
    {
        return $this->type !== 'page' && ! empty($this->url) && $this->url !== '#';
    }

    public function getTargetUrlAttribute(): string
    {
        if ($this->type === 'page' && $this->slug) {
            return route('layanan.show', $this->slug);
        }

        return $this->url ?: '#';
    }

    public function getTotalDistrictCountAttribute(): int
    {
        if (! is_array($this->district_counts)) {
            return 0;
        }

        return (int) array_sum($this->district_counts);
    }

    /**
     * @return array<int, array{name: string, count: int, percentage: float}>
     */
    public function getDistrictDataList(): array
    {
        $counts = is_array($this->district_counts) ? $this->district_counts : [];
        $total = $this->total_district_count > 0 ? $this->total_district_count : 1;
        $list = [];

        foreach (self::PURBALINGGA_DISTRICTS as $district) {
            $c = (int) ($counts[$district] ?? 0);
            $list[] = [
                'name' => $district,
                'count' => $c,
                'percentage' => round(($c / $total) * 100, 1),
            ];
        }

        return $list;
    }
}
