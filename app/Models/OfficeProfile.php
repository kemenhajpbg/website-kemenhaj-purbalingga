<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeProfile extends Model
{
    protected $fillable = [
        'title',
        'content',
        'video_url',
        'image',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
