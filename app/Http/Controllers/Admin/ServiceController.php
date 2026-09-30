<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.form', [
            'service' => new Service([
                'sort_order' => ((int) Service::query()->max('sort_order')) + 1,
                'is_active' => true,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['icon'] = $request->hasFile('icon_file')
            ? $this->storeIcon($request)
            : 'images/icon1.png';

        Service::query()->create($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $layanan): View
    {
        return view('admin.services.form', ['service' => $layanan]);
    }

    public function update(Request $request, Service $layanan): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('icon_file')) {
            $this->deleteOldIcon($layanan);
            $data['icon'] = $this->storeIcon($request, $layanan);
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $layanan): RedirectResponse
    {
        $this->deleteOldIcon($layanan);
        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'icon_file' => ['nullable', 'image', 'max:2048'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
        ];
    }

    private function storeIcon(Request $request, ?Service $service = null): string
    {
        $file = $request->file('icon_file');
        $filename = 'icon-'.($service?->id ?? time()).'-'.uniqid().'.'.$file->getClientOriginalExtension();
        $dir = public_path('images');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file->move($dir, $filename);

        return 'images/'.$filename;
    }

    private function deleteOldIcon(Service $service): void
    {
        $defaultIcons = [
            'images/icon1.png', 'images/icon2.png', 'images/icon3.png',
            'images/icon4.png', 'images/icon5.png', 'images/icon6.png',
        ];

        if ($service->icon && ! in_array($service->icon, $defaultIcons, true) && file_exists(public_path($service->icon))) {
            @unlink(public_path($service->icon));
        }
    }
}
