<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::query()
            ->published()
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('pages.berita.index', compact('news'));
    }

    public function show(string $slug): View
    {
        $query = News::query();

        // Admin yang sedang login dapat melihat berita draft/jadwal masa depan (preview)
        if (! auth()->check()) {
            $query->published();
        }

        $article = $query->where('slug', $slug)->firstOrFail();

        $related = News::query()
            ->when(! auth()->check(), fn ($q) => $q->published())
            ->where('id', '!=', $article->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('pages.berita.show', compact('article', 'related'));
    }
}
