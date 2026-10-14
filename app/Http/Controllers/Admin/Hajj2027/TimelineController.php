<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Timeline;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TimelineController extends Controller
{
    public function index(): View
    {
        $timelines = Hajj2027Timeline::query()->orderBy('urutan')->orderBy('id')->get();

        return view('admin.hajj-2027.timelines.index', compact('timelines'));
    }

    public function create(): View
    {
        $timeline = new Hajj2027Timeline([
            'status' => 'Akan Datang',
            'urutan' => (Hajj2027Timeline::query()->max('urutan') ?? 0) + 1,
            'aktif' => true,
        ]);

        return view('admin.hajj-2027.timelines.form', compact('timeline'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        Hajj2027Timeline::query()->create($data);

        return redirect()->route('admin.jemaah-2027.timelines.index')->with('success', 'Agenda timeline berhasil ditambahkan.');
    }

    public function edit(Hajj2027Timeline $timeline): View
    {
        return view('admin.hajj-2027.timelines.form', ['timeline' => $timeline]);
    }

    public function update(Request $request, Hajj2027Timeline $timeline): RedirectResponse
    {
        $data = $this->validated($request);
        $timeline->update($data);

        return redirect()->route('admin.jemaah-2027.timelines.index')->with('success', 'Agenda timeline berhasil diperbarui.');
    }

    public function destroy(Hajj2027Timeline $timeline): RedirectResponse
    {
        $timeline->delete();

        return redirect()->route('admin.jemaah-2027.timelines.index')->with('success', 'Agenda timeline berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama_tahap' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'string', 'max:150'],
            'status' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'urutan' => ['required', 'integer'],
            'aktif' => ['sometimes', 'boolean'],
        ]);

        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }
}
