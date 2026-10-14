<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hajj2027Stat extends Model
{
    protected $table = 'hajj_2027_stats';

    protected $fillable = [
        'total_jemaah',
        'total_kecamatan',
        'jemaah_pria',
        'jemaah_wanita',
        'jemaah_lansia',
        'total_kloter',
        'keterangan',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'total_jemaah' => 'integer',
            'total_kecamatan' => 'integer',
            'jemaah_pria' => 'integer',
            'jemaah_wanita' => 'integer',
            'jemaah_lansia' => 'integer',
            'total_kloter' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    public static function current(): ?self
    {
        return static::query()->latest()->first();
    }
}
