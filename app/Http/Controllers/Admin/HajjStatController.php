<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HajjStat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HajjStatController extends Controller
{
    public function edit(): View
    {
        $stat = HajjStat::query()->orderByDesc('data_date')->orderByDesc('id')->first()
            ?? new HajjStat(array_merge(HajjStat::defaults(), [
                'data_date' => now()->toDateString(),
                'is_published' => true,
            ]));

        return view('admin.hajj-stats.edit', compact('stat'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'data_date' => ['required', 'date'],
            'elderly_count' => ['required', 'integer', 'min:0'],
            'waiting_period' => ['required', 'string', 'max:100'],
            'total_registrants' => ['required', 'integer', 'min:0'],
            'is_published' => ['sometimes', 'boolean'],
            'monthly_registrants' => ['required', 'array'],
            'monthly_registrants.*' => ['integer', 'min:0'],
            'gender' => ['required', 'array'],
            'gender.*' => ['integer', 'min:0'],
            'occupation' => ['required', 'array'],
            'occupation.*' => ['integer', 'min:0'],
            'education' => ['required', 'array'],
            'education.*' => ['integer', 'min:0'],
            'age' => ['required', 'array'],
            'age.*' => ['integer', 'min:0'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        $stat = HajjStat::query()->orderByDesc('data_date')->orderByDesc('id')->first();

        if ($stat) {
            $stat->update($data);
        } else {
            HajjStat::query()->create($data);
        }

        return redirect()
            ->route('admin.hajj-stats.edit')
            ->with('success', 'Data jemaah haji berhasil disimpan.');
    }
}
