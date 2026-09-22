<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('admin.news.index', [
            'newsList' => News::query()->orderByDesc('published_at')->orderByDesc('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.news.form', ['article' => new News]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = News::uniqueSlug($data['title']);

        if ($request->hasFile('image_file')) {
            $data['image'] = $this->storeImage($request);
        }

        News::query()->create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $beritum): View
    {
        return view('admin.news.form', ['article' => $beritum]);
    }

    public function update(Request $request, News $beritum): RedirectResponse
    {
        $data = $this->validated($request);

        if ($data['title'] !== $beritum->title) {
            $data['slug'] = News::uniqueSlug($data['title'], $beritum->id);
        }

        if ($request->hasFile('image_file')) {
            $data['image'] = $this->storeImage($request, $beritum);
        }

        $beritum->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $beritum): RedirectResponse
    {
        $beritum->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['sometimes', 'boolean'],
            'image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }

    private function storeImage(Request $request, ?News $article = null): string
    {
        $file = $request->file('image_file');
        $ext = strtolower($file->getClientOriginalExtension());
        $filename = 'news-'.($article?->id ?? time()).'.'.$ext;
        $dir = public_path('images/news');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $targetPath = $dir.'/'.$filename;
        $file->move($dir, $filename);

        // Optimize image for web & social media (WhatsApp requires <300KB)
        $optimizedPath = $this->optimizeImage($targetPath, $ext);

        return 'images/news/'.basename($optimizedPath);
    }

    private function optimizeImage(string $path, string $ext): string
    {
        if (! extension_loaded('gd') || ! file_exists($path)) {
            return $path;
        }

        $info = @getimagesize($path);
        if (! $info) {
            return $path;
        }

        $width = $info[0];
        $height = $info[1];
        $maxWidth = 1200;
        $maxBytes = 290 * 1024; // Di bawah 300KB untuk persyaratan WhatsApp

        // Jika dimensi dan ukuran sudah kecil, tidak perlu diubah
        if ($width <= $maxWidth && filesize($path) <= $maxBytes) {
            return $path;
        }

        $newWidth = min($width, $maxWidth);
        $newHeight = (int) round($height * ($newWidth / $width));

        // Load image resource
        $src = null;
        if (in_array($ext, ['jpg', 'jpeg'])) {
            $src = @imagecreatefromjpeg($path);
        } elseif ($ext === 'png') {
            $src = @imagecreatefrompng($path);
        } elseif ($ext === 'webp' && function_exists('imagecreatefromwebp')) {
            $src = @imagecreatefromwebp($path);
        }

        if (! $src) {
            $src = @imagecreatefromstring((string) file_get_contents($path));
        }

        if (! $src) {
            return $path;
        }

        $dst = imagecreatetruecolor($newWidth, $newHeight);

        // Jaga transparansi jika PNG atau WebP
        if (in_array($ext, ['png', 'webp'])) {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
        }

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagedestroy($src);

        // Simpan gambar yang telah dioptimasi
        if (in_array($ext, ['jpg', 'jpeg'])) {
            $quality = 82;
            imagejpeg($dst, $path, $quality);
            while (filesize($path) > $maxBytes && $quality > 50) {
                $quality -= 8;
                imagejpeg($dst, $path, $quality);
            }
        } elseif ($ext === 'png') {
            imagepng($dst, $path, 8);
            // Jika PNG foto masih > 290KB, konversi ke JPG berkualitas tinggi agar diterima WhatsApp
            if (filesize($path) > $maxBytes) {
                $jpgPath = preg_replace('/\.png$/i', '.jpg', $path);
                $jpgDst = imagecreatetruecolor($newWidth, $newHeight);
                $white = imagecolorallocate($jpgDst, 255, 255, 255);
                imagefilledrectangle($jpgDst, 0, 0, $newWidth, $newHeight, $white);
                imagecopy($jpgDst, $dst, 0, 0, 0, 0, $newWidth, $newHeight);
                imagejpeg($jpgDst, $jpgPath, 80);
                imagedestroy($jpgDst);
                if (file_exists($jpgPath) && filesize($jpgPath) <= $maxBytes) {
                    @unlink($path);
                    imagedestroy($dst);
                    return $jpgPath;
                }
            }
        } elseif ($ext === 'webp' && function_exists('imagewebp')) {
            imagewebp($dst, $path, 80);
        }

        imagedestroy($dst);

        return $path;
    }
}
