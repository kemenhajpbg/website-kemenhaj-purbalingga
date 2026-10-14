<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Stage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StageController extends Controller
{
    public function index(): View
    {
        $stages = Hajj2027Stage::query()->orderBy('urutan')->orderBy('id')->get();

        return view('admin.hajj-2027.stages.index', compact('stages'));
    }

    public function create(): View
    {
        $stage = new Hajj2027Stage([
            'persentase' => 0,
            'status' => 'Belum Dimulai',
            'urutan' => (Hajj2027Stage::query()->max('urutan') ?? 0) + 1,
            'aktif' => true,
        ]);

        return view('admin.hajj-2027.stages.form', compact('stage'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        Hajj2027Stage::query()->create($data);

        return redirect()->route('admin.jemaah-2027.stages.index')->with('success', 'Tahapan persiapan berhasil ditambahkan.');
    }

    public function edit(Hajj2027Stage $stage): View
    {
        return view('admin.hajj-2027.stages.form', ['stage' => $stage]);
    }

    public function update(Request $request, Hajj2027Stage $stage): RedirectResponse
    {
        $data = $this->validated($request);
        $stage->update($data);

        return redirect()->route('admin.jemaah-2027.stages.index')->with('success', 'Tahapan persiapan berhasil diperbarui.');
    }

    public function destroy(Hajj2027Stage $stage): RedirectResponse
    {
        $stage->delete();

        return redirect()->route('admin.jemaah-2027.stages.index')->with('success', 'Tahapan persiapan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama_tahapan' => ['required', 'string', 'max:255'],
            'persentase' => ['required', 'integer', 'min:0', 'max:100'],
            'status' => ['required', 'string', 'max:100'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'tanggal_update' => ['nullable', 'date'],
            'urutan' => ['required', 'integer'],
            'aktif' => ['sometimes', 'boolean'],
        ]);

        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }
}
