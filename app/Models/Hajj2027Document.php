<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Hajj2027Document extends Model
{
    protected $table = 'hajj_2027_documents';

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'file',
        'file_name',
        'file_size',
        'tanggal',
        'status',
        'urutan',
        'download_count',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'urutan' => 'integer',
            'download_count' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'Aktif')
            ->orderBy('urutan')
            ->orderByDesc('tanggal')
            ->orderByDesc('id');
    }

    public const CATEGORY_OPTIONS = [
        'Panduan',
        'Dokumen & Form',
        'Regulasi & Edaran',
        'Jadwal & Agenda',
    ];
}
