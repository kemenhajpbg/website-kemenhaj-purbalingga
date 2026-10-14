<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Stat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatController extends Controller
{
    public function edit(): View
    {
        $stat = Hajj2027Stat::current() ?? new Hajj2027Stat([
            'total_jemaah' => null,
            'total_kecamatan' => 18,
            'jemaah_pria' => null,
            'jemaah_wanita' => null,
            'jemaah_lansia' => null,
            'total_kloter' => null,
            'is_published' => true,
        ]);

        return view('admin.hajj-2027.stats.edit', compact('stat'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'total_jemaah' => ['nullable', 'integer', 'min:0'],
            'total_kecamatan' => ['nullable', 'integer', 'min:0'],
            'jemaah_pria' => ['nullable', 'integer', 'min:0'],
            'jemaah_wanita' => ['nullable', 'integer', 'min:0'],
            'jemaah_lansia' => ['nullable', 'integer', 'min:0'],
            'total_kloter' => ['nullable', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        $stat = Hajj2027Stat::current();

        if ($stat) {
            $stat->update($data);
        } else {
            Hajj2027Stat::query()->create($data);
        }

        return redirect()
            ->route('admin.jemaah-2027.stats.edit')
            ->with('success', 'Statistik Jemaah Haji 2027 berhasil diperbarui.');
    }
}
