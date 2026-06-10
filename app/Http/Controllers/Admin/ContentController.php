<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    private const TEXT_KEYS = [
        'site_title',
        'brand_line_1',
        'brand_line_2',
        'hero_title',
        'hero_subtitle',
        'satuhaji_title',
        'satuhaji_description',
        'satuhaji_button_text',
        'satuhaji_button_url',
        'mall_title',
        'cta_title_line1',
        'cta_title_line2',
        'cta_button_text',
        'cta_url',
        'contact_address',
        'contact_email',
        'contact_phone',
        'contact_hours',
        'map_embed_url',
        'map_external_url',
        'map_button_text',
    ];

    private const IMAGE_FIELDS = [
        'image_logo_kemenhaj' => 'logo-kemenhaj.png',
        'image_hero_pejabat' => 'pejabat.png',
        'image_satuhaji' => 'satuhaji.png',
    ];

    public function edit(): View
    {
        return view('admin.content.edit', [
            's' => SiteSetting::allKeyed(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_title' => ['required', 'string', 'max:255'],
            'brand_line_1' => ['required', 'string', 'max:255'],
            'brand_line_2' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string'],
            'satuhaji_title' => ['required', 'string', 'max:255'],
            'satuhaji_description' => ['required', 'string'],
            'satuhaji_button_text' => ['required', 'string', 'max:100'],
            'satuhaji_button_url' => ['nullable', 'string', 'max:500'],
            'mall_title' => ['required', 'string', 'max:255'],
            'cta_title_line1' => ['required', 'string', 'max:255'],
            'cta_title_line2' => ['required', 'string', 'max:255'],
            'cta_button_text' => ['required', 'string', 'max:100'],
            'cta_url' => ['nullable', 'string', 'max:500'],
            'contact_address' => ['required', 'string'],
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:50'],
            'contact_hours' => ['required', 'string'],
            'map_embed_url' => ['required', 'string', 'max:1000'],
            'map_external_url' => ['nullable', 'string', 'max:500'],
            'map_button_text' => ['required', 'string', 'max:100'],
            'image_logo_kemenhaj' => ['nullable', 'image', 'max:2048'],
            'image_hero_pejabat' => ['nullable', 'image', 'max:5120'],
            'image_satuhaji' => ['nullable', 'image', 'max:2048'],
        ]);

        foreach (self::TEXT_KEYS as $key) {
            SiteSetting::set($key, $data[$key] ?? null);
        }

        foreach (self::IMAGE_FIELDS as $field => $filename) {
            if ($request->hasFile($field)) {
                $request->file($field)->move(public_path('images'), $filename);
                SiteSetting::set($field, 'images/'.$filename);
            }
        }

        return redirect()
            ->route('admin.content.edit')
            ->with('success', 'Konten website berhasil disimpan.');
    }
}
