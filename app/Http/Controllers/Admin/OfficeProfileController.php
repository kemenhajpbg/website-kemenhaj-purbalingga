<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfficeProfileController extends Controller
{
    public function index(): View
    {
        return view('admin.office-profile.index', [
            'sections' => OfficeProfile::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.office-profile.form', ['section' => new OfficeProfile]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image_file')) {
            $data['image'] = $this->storeImage($request);
        }

        OfficeProfile::query()->create($data);

        return redirect()->route('admin.profil.index')->with('success', 'Bagian profil berhasil ditambahkan.');
    }

    public function edit(OfficeProfile $profil): View
    {
        return view('admin.office-profile.form', ['section' => $profil]);
    }

    public function update(Request $request, OfficeProfile $profil): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image_file')) {
            $data['image'] = $this->storeImage($request, $profil);
        }

        $profil->update($data);

        return redirect()->route('admin.profil.index')->with('success', 'Bagian profil berhasil diperbarui.');
    }

    public function destroy(OfficeProfile $profil): RedirectResponse
    {
        if ($profil->image && file_exists(public_path($profil->image))) {
            @unlink(public_path($profil->image));
        }

        $profil->delete();

        return redirect()->route('admin.profil.index')->with('success', 'Bagian profil berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'video_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function storeImage(Request $request, ?OfficeProfile $section = null): string
    {
        $file = $request->file('image_file');
        $filename = 'profile-'.($section?->id ?? time()).'.'.$file->getClientOriginalExtension();
        $dir = public_path('images/profile');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Clean up old image if changing
        if ($section && $section->image && file_exists(public_path($section->image))) {
            @unlink(public_path($section->image));
        }

        $file->move($dir, $filename);

        return 'images/profile/'.$filename;
    }
}
