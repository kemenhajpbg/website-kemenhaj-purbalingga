<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Hajj2027Service::query()->orderBy('urutan')->orderBy('id')->get();

        return view('admin.hajj-2027.services.index', compact('services'));
    }

    public function create(): View
    {
        $service = new Hajj2027Service([
            'icon' => 'support',
            'urutan' => (Hajj2027Service::query()->max('urutan') ?? 0) + 1,
            'aktif' => true,
        ]);

        return view('admin.hajj-2027.services.form', compact('service'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        Hajj2027Service::query()->create($data);

        return redirect()->route('admin.jemaah-2027.services.index')->with('success', 'Layanan jemaah berhasil ditambahkan.');
    }

    public function edit(Hajj2027Service $service): View
    {
        return view('admin.hajj-2027.services.form', compact('service'));
    }

    public function update(Request $request, Hajj2027Service $service): RedirectResponse
    {
        $data = $this->validated($request);
        $service->update($data);

        return redirect()->route('admin.jemaah-2027.services.index')->with('success', 'Layanan jemaah berhasil diperbarui.');
    }

    public function destroy(Hajj2027Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.jemaah-2027.services.index')->with('success', 'Layanan jemaah berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:50'],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'urutan' => ['required', 'integer'],
            'aktif' => ['sometimes', 'boolean'],
        ]);

        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }
}
