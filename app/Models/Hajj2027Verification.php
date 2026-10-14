<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Hajj2027Verification extends Model
{
    protected $table = 'hajj_2027_verifications';

    protected $fillable = [
        'nama_tahap',
        'total',
        'siap',
        'ditunda',
        'meninggal',
        'sudah_berhaji_belum_memenuhi',
        'keterangan',
        'tanggal_update',
        'urutan',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'total' => 'integer',
            'siap' => 'integer',
            'ditunda' => 'integer',
            'meninggal' => 'integer',
            'sudah_berhaji_belum_memenuhi' => 'integer',
            'tanggal_update' => 'date',
            'urutan' => 'integer',
            'aktif' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('aktif', true)->orderBy('urutan')->orderBy('id');
    }
}
