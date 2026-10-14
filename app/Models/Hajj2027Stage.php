<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Hajj2027Stage extends Model
{
    protected $table = 'hajj_2027_stages';

    protected $fillable = [
        'nama_tahapan',
        'persentase',
        'status',
        'keterangan',
        'tanggal_update',
        'urutan',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'persentase' => 'integer',
            'tanggal_update' => 'date',
            'urutan' => 'integer',
            'aktif' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('aktif', true)->orderBy('urutan')->orderBy('id');
    }

    public const STATUS_OPTIONS = [
        'Belum Dimulai',
        'Sedang Berlangsung',
        'Selesai',
        'Menunggu Penetapan',
    ];
}
