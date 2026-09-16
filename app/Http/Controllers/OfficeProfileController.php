<?php

namespace App\Http\Controllers;

use App\Models\OfficeProfile;
use Illuminate\View\View;

class OfficeProfileController extends Controller
{
    public function index(): View
    {
        $sections = OfficeProfile::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $officials = \App\Models\Official::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('pages.profil', [
            'sections' => $sections,
            'officials' => $officials,
        ]);
    }
}
