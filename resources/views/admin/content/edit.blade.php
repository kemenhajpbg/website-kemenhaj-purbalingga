@extends('admin.layout')

@section('title', 'Konten Website')

@section('content')
    <h2 style="margin-top:0;">Konten Website</h2>

    <form method="POST" action="{{ route('admin.content.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="admin-card">
            <h2>Brand / Logo</h2>
            <div class="form-group">
                <label for="site_title">Nama website (tab browser)</label>
                <input type="text" id="site_title" name="site_title" value="{{ old('site_title', $s['site_title'] ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga') }}" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="brand_line_1">Baris teks 1</label>
                    <input type="text" id="brand_line_1" name="brand_line_1" value="{{ old('brand_line_1', $s['brand_line_1'] ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="brand_line_2">Baris teks 2</label>
                    <input type="text" id="brand_line_2" name="brand_line_2" value="{{ old('brand_line_2', $s['brand_line_2'] ?? '') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="image_logo_kemenhaj">Logo Kemenhaj (ganti file)</label>
                <input type="file" id="image_logo_kemenhaj" name="image_logo_kemenhaj" accept="image/*">
                @if (!empty($s['image_logo_kemenhaj']))
                    <img src="{{ asset($s['image_logo_kemenhaj']) }}" alt="" class="preview-img">
                @endif
            </div>
        </div>

        <div class="admin-card">
            <h2>Hero</h2>
            <div class="form-group">
                <label for="hero_title">Judul utama</label>
                <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title', $s['hero_title'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="hero_subtitle">Subjudul (baris baru = enter)</label>
                <textarea id="hero_subtitle" name="hero_subtitle" required>{{ old('hero_subtitle', $s['hero_subtitle'] ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label for="image_hero_pejabat">Foto pejabat (ganti file)</label>
                <input type="file" id="image_hero_pejabat" name="image_hero_pejabat" accept="image/*">
                @if (!empty($s['image_hero_pejabat']))
                    <img src="{{ asset($s['image_hero_pejabat']) }}" alt="" class="preview-img" style="max-height:100px;">
                @endif
            </div>
        </div>

        <div class="admin-card">
            <h2>Aplikasi Satu Haji</h2>
            <div class="form-group">
                <label for="satuhaji_title">Judul</label>
                <input type="text" id="satuhaji_title" name="satuhaji_title" value="{{ old('satuhaji_title', $s['satuhaji_title'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="satuhaji_description">Deskripsi</label>
                <textarea id="satuhaji_description" name="satuhaji_description" required>{{ old('satuhaji_description', $s['satuhaji_description'] ?? '') }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="satuhaji_button_text">Teks tombol</label>
                    <input type="text" id="satuhaji_button_text" name="satuhaji_button_text" value="{{ old('satuhaji_button_text', $s['satuhaji_button_text'] ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="satuhaji_button_url">URL tombol</label>
                    <input type="url" id="satuhaji_button_url" name="satuhaji_button_url" value="{{ old('satuhaji_button_url', $s['satuhaji_button_url'] ?? '') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="image_satuhaji">Logo Satu Haji (ganti file)</label>
                <input type="file" id="image_satuhaji" name="image_satuhaji" accept="image/*">
                @if (!empty($s['image_satuhaji']))
                    <img src="{{ asset($s['image_satuhaji']) }}" alt="" class="preview-img">
                @endif
            </div>
        </div>

        <div class="admin-card">
            <h2>Mall Layanan</h2>
            <div class="form-group">
                <label for="mall_title">Judul section</label>
                <input type="text" id="mall_title" name="mall_title" value="{{ old('mall_title', $s['mall_title'] ?? '') }}" required>
            </div>
            <p style="font-size:0.85rem;color:#5c6b66;">Kartu layanan dikelola di menu <a href="{{ route('admin.layanan.index') }}">Mall Layanan</a>.</p>
        </div>

        <div class="admin-card">
            <h2>CTA Estimasi Keberangkatan</h2>
            <div class="form-row">
                <div class="form-group">
                    <label for="cta_title_line1">Baris judul 1</label>
                    <input type="text" id="cta_title_line1" name="cta_title_line1" value="{{ old('cta_title_line1', $s['cta_title_line1'] ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="cta_title_line2">Baris judul 2</label>
                    <input type="text" id="cta_title_line2" name="cta_title_line2" value="{{ old('cta_title_line2', $s['cta_title_line2'] ?? '') }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="cta_button_text">Teks tombol</label>
                    <input type="text" id="cta_button_text" name="cta_button_text" value="{{ old('cta_button_text', $s['cta_button_text'] ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="cta_url">URL tombol</label>
                    <input type="url" id="cta_url" name="cta_url" value="{{ old('cta_url', $s['cta_url'] ?? '') }}">
                </div>
            </div>
        </div>

        <div class="admin-card">
            <h2>Lokasi Kantor</h2>
            <div class="form-group">
                <label for="contact_address">Alamat</label>
                <textarea id="contact_address" name="contact_address" required>{{ old('contact_address', $s['contact_address'] ?? '') }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="contact_email">Email</label>
                    <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $s['contact_email'] ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="contact_phone">Telepon</label>
                    <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $s['contact_phone'] ?? '') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="contact_hours">Waktu layanan (baris baru = enter)</label>
                <textarea id="contact_hours" name="contact_hours" required>{{ old('contact_hours', $s['contact_hours'] ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label for="map_embed_url">URL embed Google Maps (iframe)</label>
                <input type="url" id="map_embed_url" name="map_embed_url" value="{{ old('map_embed_url', $s['map_embed_url'] ?? '') }}" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="map_external_url">URL tombol Lokasi</label>
                    <input type="url" id="map_external_url" name="map_external_url" value="{{ old('map_external_url', $s['map_external_url'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="map_button_text">Teks tombol peta</label>
                    <input type="text" id="map_button_text" name="map_button_text" value="{{ old('map_button_text', $s['map_button_text'] ?? '') }}" required>
                </div>
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Semua Konten</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
