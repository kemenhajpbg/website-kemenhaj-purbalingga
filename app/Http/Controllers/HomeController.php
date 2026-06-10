<?php

namespace App\Http\Controllers;

use App\Models\HajjStat;
use App\Models\News;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            's' => SiteSetting::allKeyed(),
            'services' => Service::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get(),
            'latestNews' => News::query()
                ->published()
                ->orderByDesc('published_at')
                ->limit(3)
                ->get(),
            'hajjStat' => HajjStat::latestPublished(),
        ]);
    }
}
