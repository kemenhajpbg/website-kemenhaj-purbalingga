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
        $this->optimizeImage($targetPath, $ext);

        return 'images/news/'.$filename;
    }

    private function optimizeImage(string $path, string $ext): void
    {
        if (! extension_loaded('gd') || ! file_exists($path)) {
            return;
        }

        $info = @getimagesize($path);
        if (! $info) {
            return;
        }

        $width = $info[0];
        $height = $info[1];
        $maxWidth = 1200;

        if ($width > $maxWidth || filesize($path) > 300 * 1024) {
            $newWidth = min($width, $maxWidth);
            $newHeight = (int) ($height * ($newWidth / $width));

            if (in_array($ext, ['jpg', 'jpeg'])) {
                $src = @imagecreatefromjpeg($path);
                if ($src) {
                    $dst = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($dst, $path, 82);
                    imagedestroy($src);
                    imagedestroy($dst);
                }
            } elseif ($ext === 'png') {
                $src = @imagecreatefrompng($path);
                if ($src) {
                    $dst = imagecreatetruecolor($newWidth, $newHeight);
                    imagealphablending($dst, false);
                    imagesavealpha($dst, true);
                    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagepng($dst, $path, 8);
                    imagedestroy($src);
                    imagedestroy($dst);
                }
            }
        }
    }
}
