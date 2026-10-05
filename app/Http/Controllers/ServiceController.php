<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function show(string $slug): View
    {
        $query = Service::query()
            ->where('type', 'page')
            ->where('slug', $slug);

        if (! auth()->check()) {
            $query->where('is_active', true);
        }

        $service = $query->firstOrFail();

        $otherServices = Service::query()
            ->where('id', '!=', $service->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('pages.layanan.show', [
            'service' => $service,
            'districts' => $service->getDistrictDataList(),
            'otherServices' => $otherServices,
        ]);
    }
}
