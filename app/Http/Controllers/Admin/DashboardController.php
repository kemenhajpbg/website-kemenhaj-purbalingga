<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Official;
use App\Models\Service;
use App\Models\Gallery;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'newsCount' => News::query()->count(),
            'officialsCount' => Official::query()->count(),
            'servicesCount' => Service::query()->count(),
            'galleryCount' => Gallery::query()->count(),
        ]);
    }
}
