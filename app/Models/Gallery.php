<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function getDisplayImageAttribute(): ?string
    {
        if ($this->image && file_exists(public_path($this->image))) {
            return $this->image;
        }

        if ($this->id) {
            $files = glob(public_path("images/gallery/gallery-{$this->id}-*.*"));
            if (! empty($files) && file_exists($files[0])) {
                return 'images/gallery/' . basename($files[0]);
            }

            foreach (['jpg', 'jpeg', 'png', 'webp', 'JPG', 'JPEG', 'PNG'] as $ext) {
                $path = "images/gallery/gallery-{$this->id}.{$ext}";
                if (file_exists(public_path($path))) {
                    return $path;
                }
            }
        }

        return $this->image ?: null;
    }
}
