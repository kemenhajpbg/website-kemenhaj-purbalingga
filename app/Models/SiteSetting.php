<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, ?string $default = null): ?string
    {
        $value = static::query()->where('key', $key)->value('value');

        return $value !== null && $value !== '' ? $value : $default;
    }

    public static function set(string $key, ?string $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value],
        );
    }

    /**
     * @return array<string, string|null>
     */
    public static function allKeyed(): array
    {
        return static::query()->pluck('value', 'key')->all();
    }

    /**
     * @param  array<string, string|null>  $pairs
     */
    public static function setMany(array $pairs): void
    {
        foreach ($pairs as $key => $value) {
            static::set($key, $value);
        }
    }
}
