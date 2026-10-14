<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Hajj2027District extends Model
{
    protected $table = 'hajj_2027_districts';

    protected $fillable = [
        'nama_kecamatan',
        'jumlah_jemaah',
        'urutan',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_jemaah' => 'integer',
            'urutan' => 'integer',
            'aktif' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('aktif', true)->orderBy('urutan')->orderBy('nama_kecamatan');
    }
}
