<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Official;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfficialController extends Controller
{
    public function index(): View
    {
        return view('admin.officials.index', [
            'officials' => Official::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.officials.form', ['official' => new Official]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image_file')) {
            $data['image'] = $this->storeImage($request);
        }

        Official::query()->create($data);

        return redirect()->route('admin.pejabat.index')->with('success', 'Data pejabat berhasil ditambahkan.');
    }

    public function edit(Official $official): View
    {
        return view('admin.officials.form', ['official' => $official]);
    }

    public function update(Request $request, Official $official): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image_file')) {
            if ($official->image && file_exists(public_path($official->image))) {
                @unlink(public_path($official->image));
            }
            $data['image'] = $this->storeImage($request, $official);
        }

        $official->update($data);

        return redirect()->route('admin.pejabat.index')->with('success', 'Data pejabat berhasil diperbarui.');
    }

    public function destroy(Official $official): RedirectResponse
    {
        if ($official->image && file_exists(public_path($official->image))) {
            @unlink(public_path($official->image));
        }

        $official->delete();

        return redirect()->route('admin.pejabat.index')->with('success', 'Data pejabat berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'image_file' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function storeImage(Request $request, ?Official $official = null): string
    {
        $file = $request->file('image_file');
        $filename = 'official-'.($official?->id ?? time()).'-'.uniqid().'.'.$file->getClientOriginalExtension();
        $dir = public_path('images/officials');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file->move($dir, $filename);

        return 'images/officials/'.$filename;
    }
}
