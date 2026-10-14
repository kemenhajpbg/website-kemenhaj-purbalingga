<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Announcement;
use App\Models\Hajj2027Biometric;
use App\Models\Hajj2027District;
use App\Models\Hajj2027Document;
use App\Models\Hajj2027Kloter;
use App\Models\Hajj2027Stage;
use App\Models\Hajj2027Stat;
use App\Models\Hajj2027Timeline;
use App\Models\Hajj2027Verification;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stat = Hajj2027Stat::current();
        $biometric = Hajj2027Biometric::current();
        $stages = Hajj2027Stage::query()->orderBy('urutan')->get();
        $districtsCount = Hajj2027District::query()->count();
        $districtsTotalPilgrims = Hajj2027District::query()->where('aktif', true)->sum('jumlah_jemaah');
        $klotersCount = Hajj2027Kloter::query()->where('status', '!=', 'Belum Ditetapkan')->count();
        $announcementsCount = Hajj2027Announcement::query()->count();
        $documentsCount = Hajj2027Document::query()->count();
        $verificationsCount = Hajj2027Verification::query()->count();

        $latestTimestamp = collect([
            Hajj2027Stat::query()->max('updated_at'),
            Hajj2027Stage::query()->max('updated_at'),
            Hajj2027Verification::query()->max('updated_at'),
            Hajj2027Biometric::query()->max('updated_at'),
            Hajj2027District::query()->max('updated_at'),
            Hajj2027Timeline::query()->max('updated_at'),
            Hajj2027Kloter::query()->max('updated_at'),
            Hajj2027Announcement::query()->max('updated_at'),
            Hajj2027Document::query()->max('updated_at'),
        ])->filter()->sortDesc()->first();

        $lastUpdatedFormatted = $latestTimestamp
            ? Carbon::parse($latestTimestamp)->locale('id')->translatedFormat('d F Y, H:i') . ' WIB'
            : Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') . ' WIB';

        return view('admin.hajj-2027.dashboard', compact(
            'stat',
            'biometric',
            'stages',
            'districtsCount',
            'districtsTotalPilgrims',
            'klotersCount',
            'announcementsCount',
            'documentsCount',
            'verificationsCount',
            'lastUpdatedFormatted'
        ));
    }
}
