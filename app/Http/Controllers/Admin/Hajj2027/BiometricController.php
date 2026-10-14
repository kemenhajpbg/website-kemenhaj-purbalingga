<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Biometric;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BiometricController extends Controller
{
    public function edit(): View
    {
        $biometric = Hajj2027Biometric::current() ?? new Hajj2027Biometric([
            'target' => 375,
            'sudah_biometrik' => 0,
            'tanggal_update' => now()->toDateString(),
            'aktif' => true,
        ]);

        return view('admin.hajj-2027.biometrics.edit', compact('biometric'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'target' => ['required', 'integer', 'min:0'],
            'sudah_biometrik' => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'tanggal_update' => ['nullable', 'date'],
            'aktif' => ['sometimes', 'boolean'],
        ]);

        $data['aktif'] = $request->boolean('aktif');

        $biometric = Hajj2027Biometric::current();

        if ($biometric) {
            $biometric->update($data);
        } else {
            Hajj2027Biometric::query()->create($data);
        }

        return redirect()
            ->route('admin.jemaah-2027.biometrics.edit')
            ->with('success', 'Data progres biometrik berhasil diperbarui.');
    }
}
