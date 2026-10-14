<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027District;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DistrictController extends Controller
{
    public function index(): View
    {
        $districts = Hajj2027District::query()->orderBy('urutan')->orderBy('nama_kecamatan')->get();
        $totalPilgrims = $districts->where('aktif', true)->sum('jumlah_jemaah');

        return view('admin.hajj-2027.districts.index', compact('districts', 'totalPilgrims'));
    }

    public function create(): View
    {
        $district = new Hajj2027District([
            'jumlah_jemaah' => 0,
            'urutan' => (Hajj2027District::query()->max('urutan') ?? 0) + 1,
            'aktif' => true,
        ]);

        return view('admin.hajj-2027.districts.form', compact('district'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        Hajj2027District::query()->create($data);

        return redirect()->route('admin.jemaah-2027.districts.index')->with('success', 'Data kecamatan berhasil ditambahkan.');
    }

    public function edit(Hajj2027District $kecamatan): View
    {
        return view('admin.hajj-2027.districts.form', ['district' => $kecamatan]);
    }

    public function update(Request $request, Hajj2027District $kecamatan): RedirectResponse
    {
        $data = $this->validated($request);
        $kecamatan->update($data);

        return redirect()->route('admin.jemaah-2027.districts.index')->with('success', 'Data kecamatan berhasil diperbarui.');
    }

    public function destroy(Hajj2027District $kecamatan): RedirectResponse
    {
        $kecamatan->delete();

        return redirect()->route('admin.jemaah-2027.districts.index')->with('success', 'Data kecamatan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama_kecamatan' => ['required', 'string', 'max:150'],
            'jumlah_jemaah' => ['required', 'integer', 'min:0'],
            'urutan' => ['required', 'integer'],
            'aktif' => ['sometimes', 'boolean'],
        ]);

        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }
}
