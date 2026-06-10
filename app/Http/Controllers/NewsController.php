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
        $article = News::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $related = News::query()
            ->published()
            ->where('id', '!=', $article->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('pages.berita.show', compact('article', 'related'));
    }
}
