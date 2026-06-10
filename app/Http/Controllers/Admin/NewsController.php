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
        $filename = 'news-'.($article?->id ?? time()).'.'.$file->getClientOriginalExtension();
        $dir = public_path('images/news');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file->move($dir, $filename);

        return 'images/news/'.$filename;
    }
}
