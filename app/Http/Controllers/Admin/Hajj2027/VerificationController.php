<?php

namespace App\Http\Controllers\Admin\Hajj2027;

use App\Http\Controllers\Controller;
use App\Models\Hajj2027Verification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function index(): View
    {
        $verifications = Hajj2027Verification::query()->orderBy('urutan')->orderBy('id')->get();

        return view('admin.hajj-2027.verifications.index', compact('verifications'));
    }

    public function create(): View
    {
        $nextNum = (Hajj2027Verification::query()->count()) + 1;
        $roman = match ($nextNum) {
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            default => (string) $nextNum,
        };

        $verification = new Hajj2027Verification([
            'nama_tahap' => 'Tahap ' . $roman,
            'total' => 0,
            'siap' => 0,
            'ditunda' => 0,
            'meninggal' => 0,
            'sudah_berhaji_belum_memenuhi' => 0,
            'tanggal_update' => now()->toDateString(),
            'urutan' => $nextNum,
            'aktif' => true,
        ]);

        return view('admin.hajj-2027.verifications.form', compact('verification'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        Hajj2027Verification::query()->create($data);

        return redirect()->route('admin.jemaah-2027.verifications.index')->with('success', 'Data tahap verifikasi berhasil ditambahkan.');
    }

    public function edit(Hajj2027Verification $verifikasi): View
    {
        return view('admin.hajj-2027.verifications.form', ['verification' => $verifikasi]);
    }

    public function update(Request $request, Hajj2027Verification $verifikasi): RedirectResponse
    {
        $data = $this->validated($request);
        $verifikasi->update($data);

        return redirect()->route('admin.jemaah-2027.verifications.index')->with('success', 'Data tahap verifikasi berhasil diperbarui.');
    }

    public function destroy(Hajj2027Verification $verifikasi): RedirectResponse
    {
        $verifikasi->delete();

        return redirect()->route('admin.jemaah-2027.verifications.index')->with('success', 'Data tahap verifikasi berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama_tahap' => ['required', 'string', 'max:100'],
            'total' => ['required', 'integer', 'min:0'],
            'siap' => ['required', 'integer', 'min:0'],
            'ditunda' => ['required', 'integer', 'min:0'],
            'meninggal' => ['required', 'integer', 'min:0'],
            'sudah_berhaji_belum_memenuhi' => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'tanggal_update' => ['nullable', 'date'],
            'urutan' => ['required', 'integer'],
            'aktif' => ['sometimes', 'boolean'],
        ]);

        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }
}
