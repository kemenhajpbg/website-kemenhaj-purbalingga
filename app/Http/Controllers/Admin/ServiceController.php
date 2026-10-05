<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(Request $request): View
    {
        $type = $request->query('type', 'page');
        if (! in_array($type, ['link', 'page'], true)) {
            $type = 'page';
        }

        return view('admin.services.form', [
            'service' => new Service([
                'type' => $type,
                'sort_order' => ((int) Service::query()->max('sort_order')) + 1,
                'is_active' => true,
                'district_counts' => array_fill_keys(Service::PURBALINGGA_DISTRICTS, 0),
            ]),
            'districts' => Service::PURBALINGGA_DISTRICTS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($data['type'] === 'page') {
            $data['slug'] = ! empty($data['slug'])
                ? Str::slug($data['slug'])
                : Service::uniqueSlug($data['title']);
            $data['district_counts'] = $this->extractDistricts($request);

            if ($request->hasFile('document_file')) {
                $docInfo = $this->storeDocument($request);
                $data['document_path'] = $docInfo['path'];
                $data['document_size'] = $docInfo['size'];
                if (empty($data['document_name'])) {
                    $data['document_name'] = $docInfo['original_name'];
                }
            }
        } else {
            $data['slug'] = null;
        }

        if ($request->hasFile('icon_file')) {
            $data['icon'] = $this->storeIcon($request);
        } elseif ($request->filled('icon_preset')) {
            $data['icon'] = $request->input('icon_preset');
        } else {
            $data['icon'] = 'images/icon1.png';
        }

        Service::query()->create($data);

        $msg = $data['type'] === 'page'
            ? 'Halaman layanan berhasil ditambahkan ke Mall Layanan.'
            : 'Tautan layanan berhasil ditambahkan.';

        return redirect()->route('admin.layanan.index')->with('success', $msg);
    }

    public function edit(Service $layanan): View
    {
        if (empty($layanan->district_counts) || ! is_array($layanan->district_counts)) {
            $layanan->district_counts = array_fill_keys(Service::PURBALINGGA_DISTRICTS, 0);
        }

        return view('admin.services.form', [
            'service' => $layanan,
            'districts' => Service::PURBALINGGA_DISTRICTS,
        ]);
    }

    public function update(Request $request, Service $layanan): RedirectResponse
    {
        $data = $this->validated($request, $layanan);

        if ($data['type'] === 'page') {
            if (! empty($data['slug'])) {
                $data['slug'] = Str::slug($data['slug']);
            } elseif ($data['title'] !== $layanan->title || empty($layanan->slug)) {
                $data['slug'] = Service::uniqueSlug($data['title'], $layanan->id);
            } else {
                $data['slug'] = $layanan->slug;
            }

            $data['district_counts'] = $this->extractDistricts($request);

            if ($request->hasFile('document_file')) {
                $this->deleteOldDocument($layanan);
                $docInfo = $this->storeDocument($request);
                $data['document_path'] = $docInfo['path'];
                $data['document_size'] = $docInfo['size'];
                if (empty($data['document_name'])) {
                    $data['document_name'] = $docInfo['original_name'];
                }
            }
        }

        if ($request->hasFile('icon_file')) {
            $this->deleteOldIcon($layanan);
            $data['icon'] = $this->storeIcon($request, $layanan);
        } elseif ($request->filled('icon_preset')) {
            $data['icon'] = $request->input('icon_preset');
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $layanan): RedirectResponse
    {
        $this->deleteOldIcon($layanan);
        $this->deleteOldDocument($layanan);
        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Service $service = null): array
    {
        $rules = [
            'type' => ['sometimes', 'in:link,page'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'icon_file' => ['nullable', 'image', 'max:2048'],
            'icon_preset' => ['nullable', 'string', 'max:255'],
        ];

        if ($request->input('type') === 'page') {
            $rules['total_verified'] = ['nullable', 'integer', 'min:0'];
            $rules['ready_count'] = ['nullable', 'integer', 'min:0'];
            $rules['delayed_count'] = ['nullable', 'integer', 'min:0'];
            $rules['deceased_count'] = ['nullable', 'integer', 'min:0'];
            $rules['under_18_count'] = ['nullable', 'integer', 'min:0'];
            $rules['transfer_count'] = ['nullable', 'integer', 'min:0'];
            $rules['document_file'] = ['nullable', 'file', 'mimes:pdf', 'max:20480'];
            $rules['document_name'] = ['nullable', 'string', 'max:255'];
        }

        $data = $request->validate($rules);
        $data['type'] = $data['type'] ?? 'link';
        $data['is_active'] = $request->boolean('is_active');

        if ($data['type'] === 'page') {
            $data['total_verified'] = (int) ($data['total_verified'] ?? 0);
            $data['ready_count'] = (int) ($data['ready_count'] ?? 0);
            $data['delayed_count'] = (int) ($data['delayed_count'] ?? 0);
            $data['deceased_count'] = (int) ($data['deceased_count'] ?? 0);
            $data['under_18_count'] = (int) ($data['under_18_count'] ?? 0);
            $data['transfer_count'] = (int) ($data['transfer_count'] ?? 0);
        }

        return $data;
    }

    /**
     * @return array<string, int>
     */
    private function extractDistricts(Request $request): array
    {
        $input = $request->input('districts', []);
        $counts = [];

        foreach (Service::PURBALINGGA_DISTRICTS as $district) {
            $counts[$district] = max(0, (int) ($input[$district] ?? 0));
        }

        return $counts;
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

    /**
     * @return array{path: string, size: string, original_name: string}
     */
    private function storeDocument(Request $request): array
    {
        $file = $request->file('document_file');
        $sizeBytes = $file->getSize();
        $originalName = $file->getClientOriginalName();
        $filename = 'doc-'.time().'-'.uniqid().'.pdf';
        $dir = public_path('documents/services');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file->move($dir, $filename);

        return [
            'path' => 'documents/services/'.$filename,
            'size' => $this->formatFileSize($sizeBytes),
            'original_name' => $originalName,
        ];
    }

    private function formatFileSize(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1).' MB';
        }
        if ($bytes >= 1024) {
            return round($bytes / 1024, 1).' KB';
        }

        return $bytes.' B';
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

    private function deleteOldDocument(Service $service): void
    {
        if ($service->document_path && file_exists(public_path($service->document_path))) {
            @unlink(public_path($service->document_path));
        }
    }
}
