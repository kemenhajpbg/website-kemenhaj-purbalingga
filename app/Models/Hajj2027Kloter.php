<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Hajj2027Kloter extends Model
{
    protected $table = 'hajj_2027_kloters';

    protected $fillable = [
        'nomor_kloter',
        'jumlah_jemaah',
        'embarkasi',
        'tanggal_masuk_asrama',
        'tanggal_keberangkatan',
        'status',
        'keterangan',
        'urutan',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_jemaah' => 'integer',
            'tanggal_masuk_asrama' => 'datetime',
            'tanggal_keberangkatan' => 'datetime',
            'urutan' => 'integer',
            'aktif' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('aktif', true)->orderBy('urutan')->orderBy('id');
    }

    public const STATUS_OPTIONS = [
        'Belum Ditetapkan',
        'Terjadwal',
        'Sudah Berangkat',
        'Dalam Perjalanan',
        'Sudah Tiba',
        'Selesai',
    ];
}
