<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::query()
            ->orderByDesc('id')
            ->get();

        return view('pages.gallery.index', compact('galleries'));
    }
}
