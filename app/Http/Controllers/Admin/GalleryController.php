<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index', [
            'galleries' => Gallery::query()->orderByDesc('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.gallery.form', ['gallery' => new Gallery]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, true);

        if ($request->hasFile('image_file')) {
            $data['image'] = $this->storeImage($request);
        }

        Gallery::query()->create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $galeri): View
    {
        return view('admin.gallery.form', ['gallery' => $galeri]);
    }

    public function update(Request $request, Gallery $galeri): RedirectResponse
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('image_file')) {
            // Delete old file
            if ($galeri->image && file_exists(public_path($galeri->image))) {
                @unlink(public_path($galeri->image));
            }
            $data['image'] = $this->storeImage($request, $galeri);
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $galeri): RedirectResponse
    {
        // Delete file
        if ($galeri->image && file_exists(public_path($galeri->image))) {
            @unlink(public_path($galeri->image));
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, bool $isCreate): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_file' => [$isCreate ? 'required' : 'nullable', 'image', 'max:4096'],
        ]);
    }

    private function storeImage(Request $request, ?Gallery $gallery = null): string
    {
        $file = $request->file('image_file');
        $filename = 'gallery-'.($gallery?->id ?? time()).'-'.uniqid().'.'.$file->getClientOriginalExtension();
        $dir = public_path('images/gallery');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file->move($dir, $filename);

        return 'images/gallery/'.$filename;
    }
}
