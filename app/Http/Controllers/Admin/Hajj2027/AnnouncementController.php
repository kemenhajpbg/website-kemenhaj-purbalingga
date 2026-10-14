<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Hajj2027Announcement::query()
            ->orderBy('urutan')
            ->orderByDesc('tanggal_publikasi')
            ->orderByDesc('id')
            ->get();

        return view('admin.hajj-2027.announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        $announcement = new Hajj2027Announcement([
            'tanggal_publikasi' => now()->toDateString(),
            'status' => 'Published',
            'urutan' => (Hajj2027Announcement::query()->max('urutan') ?? 0) + 1,
        ]);

        return view('admin.hajj-2027.announcements.form', compact('announcement'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Hajj2027Announcement::uniqueSlug($data['judul']);

        if ($request->hasFile('thumbnail_file')) {
            $data['thumbnail'] = $this->uploadFile($request->file('thumbnail_file'), 'uploads/announcements', 'thumb');
        }

        if ($request->hasFile('attachment_file')) {
            $data['file_lampiran'] = $this->uploadFile($request->file('attachment_file'), 'uploads/announcements/attachments', 'lampiran');
        }

        Hajj2027Announcement::query()->create($data);

        return redirect()->route('admin.jemaah-2027.announcements.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Hajj2027Announcement $announcement): View
    {
        return view('admin.hajj-2027.announcements.form', ['announcement' => $announcement]);
    }

    public function update(Request $request, Hajj2027Announcement $announcement): RedirectResponse
    {
        $data = $this->validated($request);

        if ($data['judul'] !== $announcement->judul) {
            $data['slug'] = Hajj2027Announcement::uniqueSlug($data['judul'], $announcement->id);
        }

        if ($request->hasFile('thumbnail_file')) {
            if ($announcement->thumbnail && file_exists(public_path($announcement->thumbnail))) {
                @unlink(public_path($announcement->thumbnail));
            }
            $data['thumbnail'] = $this->uploadFile($request->file('thumbnail_file'), 'uploads/announcements', 'thumb');
        }

        if ($request->hasFile('attachment_file')) {
            if ($announcement->file_lampiran && file_exists(public_path($announcement->file_lampiran))) {
                @unlink(public_path($announcement->file_lampiran));
            }
            $data['file_lampiran'] = $this->uploadFile($request->file('attachment_file'), 'uploads/announcements/attachments', 'lampiran');
        }

        $announcement->update($data);

        return redirect()->route('admin.jemaah-2027.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Hajj2027Announcement $announcement): RedirectResponse
    {
        if ($announcement->thumbnail && file_exists(public_path($announcement->thumbnail))) {
            @unlink(public_path($announcement->thumbnail));
        }

        if ($announcement->file_lampiran && file_exists(public_path($announcement->file_lampiran))) {
            @unlink(public_path($announcement->file_lampiran));
        }

        $announcement->delete();

        return redirect()->route('admin.jemaah-2027.announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'tanggal_publikasi' => ['nullable', 'date'],
            'status' => ['required', 'string', 'in:Draft,Published'],
            'urutan' => ['required', 'integer'],
            'thumbnail_file' => ['nullable', 'image', 'max:3072'],
            'attachment_file' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,zip', 'max:10240'],
        ]);
    }

    private function uploadFile($file, string $dir, string $prefix): string
    {
        $targetDir = public_path($dir);
        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $ext = strtolower($file->getClientOriginalExtension());
        $filename = $prefix . '-' . time() . '-' . uniqid() . '.' . $ext;
        $file->move($targetDir, $filename);

        return $dir . '/' . $filename;
    }
}
