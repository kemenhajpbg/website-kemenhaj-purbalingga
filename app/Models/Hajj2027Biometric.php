<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hajj2027Biometric extends Model
{
    protected $table = 'hajj_2027_biometrics';

    protected $fillable = [
        'target',
        'sudah_biometrik',
        'keterangan',
        'tanggal_update',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'target' => 'integer',
            'sudah_biometrik' => 'integer',
            'tanggal_update' => 'date',
            'aktif' => 'boolean',
        ];
    }

    public function getBelumBiometrikAttribute(): int
    {
        return max(0, (int) $this->target - (int) $this->sudah_biometrik);
    }

    public function getPersentaseAttribute(): float
    {
        if ($this->target <= 0) {
            return 0.0;
        }

        return round(((int) $this->sudah_biometrik / (int) $this->target) * 100, 1);
    }

    public static function current(): ?self
    {
        return static::query()->where('aktif', true)->latest()->first();
    }
}
