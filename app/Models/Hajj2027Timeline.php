<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Hajj2027Timeline extends Model
{
    protected $table = 'hajj_2027_timelines';

    protected $fillable = [
        'nama_tahap',
        'tanggal',
        'status',
        'deskripsi',
        'urutan',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
            'aktif' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('aktif', true)->orderBy('urutan')->orderBy('id');
    }

    public const STATUS_OPTIONS = [
        'Selesai',
        'Berlangsung',
        'Akan Datang',
    ];
}
