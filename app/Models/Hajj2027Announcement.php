<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Hajj2027Announcement extends Model
{
    protected $table = 'hajj_2027_announcements';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'thumbnail',
        'file_lampiran',
        'tanggal_publikasi',
        'status',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_publikasi' => 'date',
            'urutan' => 'integer',
        ];
    }

    public static function uniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $slug = Str::slug($judul);
        $original = $slug;
        $count = 1;

        while (static::query()
            ->when($ignoreId, fn (Builder $q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original.'-'.$count++;
        }

        return $slug;
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'Published')
            ->orderBy('urutan')
            ->orderByDesc('tanggal_publikasi')
            ->orderByDesc('id');
    }
}
