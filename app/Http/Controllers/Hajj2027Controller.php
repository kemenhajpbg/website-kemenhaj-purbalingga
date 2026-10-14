<?php

namespace App\Http\Controllers;

use App\Models\Hajj2027Announcement;
use App\Models\Hajj2027Biometric;
use App\Models\Hajj2027District;
use App\Models\Hajj2027Document;
use App\Models\Hajj2027Kloter;
use App\Models\Hajj2027Service;
use App\Models\Hajj2027Stage;
use App\Models\Hajj2027Stat;
use App\Models\Hajj2027Timeline;
use App\Models\Hajj2027Verification;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Hajj2027Controller extends Controller
{
    public function index(): View
    {
        $stat = Hajj2027Stat::current();
        $stages = Hajj2027Stage::active()->get();
        $verifications = Hajj2027Verification::active()->get();
        $biometric = Hajj2027Biometric::current();
        $districts = Hajj2027District::active()->get();
        $timelines = Hajj2027Timeline::active()->get();
        $kloters = Hajj2027Kloter::active()->get();
        $services = Hajj2027Service::active()->get();
        $announcements = Hajj2027Announcement::published()->limit(6)->get();

        // Berita kategori 'Haji 2027' atau terkait 2027
        $newsList = News::published()
            ->where(function ($q) {
                $q->where('category', 'Haji 2027')
                    ->orWhere('title', 'like', '%2027%')
                    ->orWhere('content', 'like', '%2027%');
            })
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        // Jika belum ada berita bertag Haji 2027, tampilkan berita terbaru agar tidak kosong
        if ($newsList->isEmpty()) {
            $newsList = News::published()->orderByDesc('published_at')->limit(3)->get();
        }

        $documents = Hajj2027Document::active()->get();

        // Tanggal update terakhir diambil otomatis dari data terbaru di database
        $latestTimestamp = collect([
            Hajj2027Stat::query()->max('updated_at'),
            Hajj2027Stage::query()->max('updated_at'),
            Hajj2027Verification::query()->max('updated_at'),
            Hajj2027Biometric::query()->max('updated_at'),
            Hajj2027District::query()->max('updated_at'),
            Hajj2027Timeline::query()->max('updated_at'),
            Hajj2027Kloter::query()->max('updated_at'),
            Hajj2027Service::query()->max('updated_at'),
            Hajj2027Announcement::query()->max('updated_at'),
            Hajj2027Document::query()->max('updated_at'),
        ])->filter()->sortDesc()->first();

        $lastUpdatedFormatted = $latestTimestamp
            ? Carbon::parse($latestTimestamp)->locale('id')->translatedFormat('d F Y, H:i') . ' WIB'
            : Carbon::now()->locale('id')->translatedFormat('d F Y, H:i') . ' WIB';

        // Hitung total jemaah kecamatan secara otomatis
        $totalDistrictPilgrims = $districts->sum('jumlah_jemaah');

        return view('pages.hajj-2027.index', compact(
            'stat',
            'stages',
            'verifications',
            'biometric',
            'districts',
            'totalDistrictPilgrims',
            'timelines',
            'kloters',
            'services',
            'announcements',
            'newsList',
            'documents',
            'lastUpdatedFormatted'
        ));
    }

    public function downloadDocument(Hajj2027Document $document)
    {
        $filePath = public_path($document->file);

        if (! file_exists($filePath)) {
            return redirect()->back()->with('error', 'Berkas dokumen tidak ditemukan.');
        }

        $document->increment('download_count');

        $downloadName = $document->file_name ?: basename($filePath);

        return response()->download($filePath, $downloadName);
    }

    public function showAnnouncement(string $slug): View
    {
        $announcement = Hajj2027Announcement::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $recentAnnouncements = Hajj2027Announcement::published()
            ->where('id', '!=', $announcement->id)
            ->limit(4)
            ->get();

        return view('pages.hajj-2027.announcement-show', compact('announcement', 'recentAnnouncements'));
    }
}
