<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Kloter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KloterController extends Controller
{
    public function index(): View
    {
        $kloters = Hajj2027Kloter::query()->orderBy('urutan')->orderBy('id')->get();

        return view('admin.hajj-2027.kloters.index', compact('kloters'));
    }

    public function create(): View
    {
        $kloter = new Hajj2027Kloter([
            'nomor_kloter' => 'Kloter ',
            'jumlah_jemaah' => 0,
            'embarkasi' => 'SOC (Solo)',
            'status' => 'Belum Ditetapkan',
            'urutan' => (Hajj2027Kloter::query()->max('urutan') ?? 0) + 1,
            'aktif' => true,
        ]);

        return view('admin.hajj-2027.kloters.form', compact('kloter'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        Hajj2027Kloter::query()->create($data);

        return redirect()->route('admin.jemaah-2027.kloters.index')->with('success', 'Data kloter berhasil ditambahkan.');
    }

    public function edit(Hajj2027Kloter $kloter): View
    {
        return view('admin.hajj-2027.kloters.form', ['kloter' => $kloter]);
    }

    public function update(Request $request, Hajj2027Kloter $kloter): RedirectResponse
    {
        $data = $this->validated($request);
        $kloter->update($data);

        return redirect()->route('admin.jemaah-2027.kloters.index')->with('success', 'Data kloter berhasil diperbarui.');
    }

    public function destroy(Hajj2027Kloter $kloter): RedirectResponse
    {
        $kloter->delete();

        return redirect()->route('admin.jemaah-2027.kloters.index')->with('success', 'Data kloter berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nomor_kloter' => ['required', 'string', 'max:100'],
            'jumlah_jemaah' => ['required', 'integer', 'min:0'],
            'embarkasi' => ['nullable', 'string', 'max:150'],
            'tanggal_masuk_asrama' => ['nullable', 'date'],
            'tanggal_keberangkatan' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:100'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'urutan' => ['required', 'integer'],
            'aktif' => ['sometimes', 'boolean'],
        ]);

        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }
}
