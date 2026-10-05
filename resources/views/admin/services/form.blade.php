@extends('admin.layout')

@section('title', $service->exists ? 'Ubah Layanan / Halaman' : 'Tambah Layanan / Halaman')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0 0 4px;">{{ $service->exists ? 'Ubah Layanan / Halaman' : 'Tambah Layanan / Halaman' }}</h2>
            <p style="margin:0;font-size:0.85rem;color:var(--admin-muted);">Tombol layanan ini akan ditampilkan pada grid Mall Layanan di halaman depan website.</p>
        </div>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <form method="POST" action="{{ $service->exists ? route('admin.layanan.update', $service) : route('admin.layanan.store') }}" enctype="multipart/form-data" class="admin-card" style="max-width:960px;">
        @csrf
        @if ($service->exists)
            @method('PUT')
        @endif

        {{-- PILIHAN TIPE LAYANAN --}}
        <div class="form-group" style="background:#f7faf9;padding:16px;border-radius:10px;border:1px solid #c2e5e1;margin-bottom:24px;">
            <label style="font-weight:700;color:var(--admin-primary-dark);font-size:0.95rem;margin-bottom:10px;display:block;">
                Jenis Layanan Mall Layanan
            </label>
            <div style="display:flex;gap:20px;flex-wrap:wrap;">
                <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-weight:600;font-size:0.9rem;">
                    <input type="radio" name="type" value="page" id="type_page" @checked(old('type', $service->type ?? 'page') === 'page') onchange="toggleTypeFields()">
                    <span>Halaman Khusus (Data Statistik Jemaah & Dokumen PDF)</span>
                </label>
                <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-weight:600;font-size:0.9rem;">
                    <input type="radio" name="type" value="link" id="type_link" @checked(old('type', $service->type) === 'link') onchange="toggleTypeFields()">
                    <span>Tautan Luar (Link Eksternal / URL)</span>
                </label>
            </div>
            <p style="margin:8px 0 0;font-size:0.8rem;color:#5c6b66;">
                Pilih <strong>Halaman Khusus</strong> untuk membuat halaman berisikan data total jemaah haji, rincian 18 kecamatan di Purbalingga, dan unggahan berkas dokumen PDF.
            </p>
        </div>

        {{-- INFORMASI DASAR --}}
        <div style="margin-bottom:28px;">
            <h3 style="font-size:1.05rem;color:var(--admin-primary-dark);border-bottom:2px solid #eef2f1;padding-bottom:8px;margin-bottom:16px;">
                1. Informasi Tombol Mall Layanan
            </h3>

            <div class="form-group">
                <label for="title">Judul Halaman / Layanan <span style="color:#e11d48;">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" placeholder="Contoh: Verifikasi Jemaah Haji Purbalingga" required>
            </div>

            <div id="slug_group" class="form-group">
                <label for="slug">Slug URL Halaman (Opsional)</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $service->slug) }}" placeholder="otomatis-dari-judul">
                <small style="color:#64748b;font-size:0.78rem;">Alamat halaman publik: <code>{{ url('/layanan') }}/[slug]</code></small>
            </div>

            <div id="url_group" class="form-group" style="display:none;">
                <label for="url">URL Tujuan Eksternal</label>
                <input type="url" id="url" name="url" value="{{ old('url', $service->url) }}" placeholder="https://drive.google.com/... atau https://haji.go.id/...">
            </div>

            <div class="form-group">
                <label for="description">Ringkasan / Keterangan Pengantar (Opsional)</label>
                <textarea id="description" name="description" rows="2" placeholder="Penjelasan singkat mengenai informasi halaman ini...">{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="sort_order">Urutan Tampilan</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 1) }}" min="0" required>
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <div class="form-check" style="margin-top:10px;">
                        <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $service->exists ? $service->is_active : true))>
                        <label for="is_active" style="margin:0;font-weight:600;">Tampilkan tombol di Mall Layanan website</label>
                    </div>
                </div>
            </div>

            {{-- PILIHAN ICON --}}
            <div class="form-group" style="background:#fcfdfd;border:1px solid #e2e8f0;padding:16px;border-radius:8px;">
                <label style="font-weight:600;margin-bottom:8px;display:block;">Pilih Icon Tombol Mall Layanan</label>
                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:14px;">
                    @foreach(['images/icon1.png', 'images/icon2.png', 'images/icon3.png', 'images/icon4.png', 'images/icon5.png', 'images/icon6.png'] as $idx => $presetIcon)
                        <label style="cursor:pointer;border:2px solid {{ old('icon_preset', $service->icon) === $presetIcon ? 'var(--admin-primary)' : '#e2e8f0' }};border-radius:8px;padding:8px 12px;display:flex;flex-direction:column;align-items:center;gap:4px;background:#fff;transition:border-color 0.2s;" class="icon-preset-label">
                            <input type="radio" name="icon_preset" value="{{ $presetIcon }}" @checked(old('icon_preset', $service->icon ?? 'images/icon1.png') === $presetIcon) style="display:none;" onchange="selectPreset(this)">
                            <img src="{{ asset($presetIcon) }}" alt="Icon {{ $idx + 1 }}" style="width:36px;height:36px;object-fit:contain;">
                            <span style="font-size:0.75rem;color:#64748b;">Icon {{ $idx + 1 }}</span>
                        </label>
                    @endforeach
                </div>

                <label for="icon_file" style="font-size:0.85rem;color:#475569;">Atau unggah icon kustom (PNG / SVG / JPG, max 2MB):</label>
                <input type="file" id="icon_file" name="icon_file" accept="image/*">
                @if ($service->icon && !str_starts_with($service->icon, 'images/icon'))
                    <div style="margin-top:6px;">
                        <span style="font-size:0.75rem;color:#5c6b66;">Icon saat ini:</span>
                        <img src="{{ asset($service->icon) }}" alt="Icon saat ini" style="width:40px;height:40px;object-fit:contain;margin-top:4px;">
                    </div>
                @endif
            </div>
        </div>

        {{-- SEKSI KHUSUS HALAMAN: DATA TOTAL JEMAAH HAJI --}}
        <div id="page_fields_container">
            <div style="margin-bottom:28px;">
                <div style="display:flex;justify-content:space-between;align-items:center;border-bottom:2px solid #eef2f1;padding-bottom:8px;margin-bottom:16px;">
                    <h3 style="font-size:1.05rem;color:var(--admin-primary-dark);margin:0;">
                        2. Data Total Jemaah Haji
                    </h3>
                    <span style="background:#e6f7f5;color:#0a7a6f;padding:3px 10px;border-radius:999px;font-size:0.75rem;font-weight:600;">
                        Statistik & Rekapitulasi
                    </span>
                </div>

                <div class="form-row--3cols" style="margin-bottom:16px;">
                    <div class="form-group" style="background:#f0fdf4;border:1px solid #bbf7d0;padding:12px;border-radius:8px;">
                        <label for="total_verified" style="color:#166534;font-weight:700;">
                            Jumlah Total Verifikasi Jemaah Berangkat
                        </label>
                        <input type="number" id="total_verified" name="total_verified" value="{{ old('total_verified', $service->total_verified ?? 0) }}" min="0" style="font-size:1.1rem;font-weight:700;color:#166534;">
                        <small style="color:#15803d;font-size:0.75rem;">Total jemaah yang telah diverifikasi</small>
                    </div>

                    <div class="form-group">
                        <label for="ready_count">Siap Berangkat</label>
                        <input type="number" id="ready_count" name="ready_count" value="{{ old('ready_count', $service->ready_count ?? 0) }}" min="0">
                        <small style="color:#64748b;font-size:0.75rem;">Jemaah siap berangkat musim ini</small>
                    </div>

                    <div class="form-group">
                        <label for="delayed_count">Tunda</label>
                        <input type="number" id="delayed_count" name="delayed_count" value="{{ old('delayed_count', $service->delayed_count ?? 0) }}" min="0">
                        <small style="color:#64748b;font-size:0.75rem;">Jemaah menunda keberangkatan</small>
                    </div>
                </div>

                <div class="form-row--3cols" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label for="deceased_count">Meninggal Dunia</label>
                        <input type="number" id="deceased_count" name="deceased_count" value="{{ old('deceased_count', $service->deceased_count ?? 0) }}" min="0">
                        <small style="color:#64748b;font-size:0.75rem;">Jemaah yang wafat sebelum berangkat</small>
                    </div>

                    <div class="form-group">
                        <label for="under_18_count">Belum 18 Tahun</label>
                        <input type="number" id="under_18_count" name="under_18_count" value="{{ old('under_18_count', $service->under_18_count ?? 0) }}" min="0">
                        <small style="color:#64748b;font-size:0.75rem;">Jemaah di bawah usia 18 tahun</small>
                    </div>

                    <div class="form-group">
                        <label for="transfer_count">Pelimpahan</label>
                        <input type="number" id="transfer_count" name="transfer_count" value="{{ old('transfer_count', $service->transfer_count ?? 0) }}" min="0">
                        <small style="color:#64748b;font-size:0.75rem;">Pelimpahan nomor porsi (sakit/wafat)</small>
                    </div>
                </div>

                {{-- RINCIAN 18 KECAMATAN DI KABUPATEN PURBALINGGA --}}
                <div style="background:#fafbfb;border:1px solid #e2e8f0;padding:18px;border-radius:10px;margin-top:20px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;margin-bottom:14px;">
                        <div>
                            <h4 style="margin:0 0 2px;color:var(--admin-primary-dark);font-size:0.95rem;">
                                Total Jemaah Per Kecamatan (18 Kecamatan di Purbalingga)
                            </h4>
                            <p style="margin:0;font-size:0.78rem;color:#64748b;">Masukkan jumlah jemaah pada masing-masing kecamatan di Kabupaten Purbalingga.</p>
                        </div>
                        <div style="background:#e6f7f5;color:#0a7a6f;padding:6px 14px;border-radius:8px;font-size:0.85rem;font-weight:700;">
                            Total 18 Kecamatan: <span id="districts_sum_display">0</span> jemaah
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(180px, 1fr));gap:12px;">
                        @php
                            $districtCounts = is_array($service->district_counts) ? $service->district_counts : [];
                        @endphp
                        @foreach ($districts as $district)
                            <div style="background:#fff;border:1px solid #cbd5e1;border-radius:6px;padding:8px 10px;">
                                <label for="dist_{{ Str::slug($district) }}" style="font-size:0.8rem;font-weight:600;color:#334155;margin-bottom:4px;display:block;">
                                    {{ $district }}
                                </label>
                                <input type="number" 
                                       id="dist_{{ Str::slug($district) }}" 
                                       name="districts[{{ $district }}]" 
                                       value="{{ old('districts.'.$district, $districtCounts[$district] ?? 0) }}" 
                                       min="0" 
                                       class="district-input" 
                                       style="padding:6px 8px;font-size:0.88rem;border:1px solid #cbd5e1;border-radius:4px;width:100%;text-align:right;" 
                                       oninput="calculateDistrictsSum()">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- SEKSI DOKUMEN PDF --}}
            <div style="margin-bottom:28px;">
                <div style="display:flex;justify-content:space-between;align-items:center;border-bottom:2px solid #eef2f1;padding-bottom:8px;margin-bottom:16px;">
                    <h3 style="font-size:1.05rem;color:var(--admin-primary-dark);margin:0;">
                        3. Berkas Dokumen (Upload PDF)
                    </h3>
                    <span style="background:#fef3c7;color:#92400e;padding:3px 10px;border-radius:999px;font-size:0.75rem;font-weight:600;">
                        PDF Dokumen Resmi
                    </span>
                </div>

                <div class="form-group">
                    <label for="document_name">Nama / Judul Dokumen (Opsional)</label>
                    <input type="text" id="document_name" name="document_name" value="{{ old('document_name', $service->document_name) }}" placeholder="Contoh: SK Penetapan Daftar Nominatif Jemaah Haji 1447H / 2026M">
                    <small style="color:#64748b;font-size:0.78rem;">Jika dikosongkan, nama file asli akan digunakan sebagai judul dokumen.</small>
                </div>

                <div class="form-group" style="background:#fcfcfd;border:2px dashed #cbd5e1;padding:20px;border-radius:10px;">
                    <label for="document_file" style="font-weight:600;margin-bottom:6px;display:block;cursor:pointer;">
                        <span style="display:inline-flex;align-items:center;gap:6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="color:#dc2626;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Unggah Dokumen PDF {{ $service->document_path ? '(Pilih file baru untuk mengganti)' : '' }}
                        </span>
                    </label>
                    <input type="file" id="document_file" name="document_file" accept=".pdf,application/pdf" style="margin-top:6px;">
                    <p style="margin:6px 0 0;font-size:0.78rem;color:#64748b;">Format berkas harus <strong>.PDF</strong> dengan ukuran maksimal 20 MB.</p>

                    @if ($service->document_path)
                        <div style="margin-top:14px;padding:12px;background:#fff;border:1px solid #e2e8f0;border-radius:8px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <span style="background:#fee2e2;color:#dc2626;padding:6px;border-radius:6px;display:flex;align-items:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </span>
                                <div>
                                    <strong style="font-size:0.85rem;color:#1e293b;display:block;">{{ $service->document_name ?: 'Dokumen PDF Tersedia' }}</strong>
                                    <span style="font-size:0.75rem;color:#64748b;">Ukuran: {{ $service->document_size ?? 'PDF' }}</span>
                                </div>
                            </div>
                            <div style="display:flex;gap:8px;">
                                <a href="{{ asset($service->document_path) }}" target="_blank" class="btn btn-secondary btn-sm" style="font-size:0.78rem;">
                                    Lihat / Unduh Dokumen Saat Ini &nearr;
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="actions" style="border-top:1px solid #e2e8f0;padding-top:20px;">
            <button type="submit" class="btn btn-primary" style="padding:10px 24px;font-size:0.95rem;">
                Simpan Layanan
            </button>
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

    <script>
        function toggleTypeFields() {
            const isPage = document.getElementById('type_page').checked;
            const pageContainer = document.getElementById('page_fields_container');
            const slugGroup = document.getElementById('slug_group');
            const urlGroup = document.getElementById('url_group');

            if (isPage) {
                pageContainer.style.display = 'block';
                slugGroup.style.display = 'block';
                urlGroup.style.display = 'none';
            } else {
                pageContainer.style.display = 'none';
                slugGroup.style.display = 'none';
                urlGroup.style.display = 'block';
            }
        }

        function selectPreset(radio) {
            document.querySelectorAll('.icon-preset-label').forEach(label => {
                label.style.borderColor = '#e2e8f0';
            });
            radio.closest('label').style.borderColor = 'var(--admin-primary)';
        }

        function calculateDistrictsSum() {
            const inputs = document.querySelectorAll('.district-input');
            let sum = 0;
            inputs.forEach(input => {
                const val = parseInt(input.value, 10);
                if (!isNaN(val) && val > 0) {
                    sum += val;
                }
            });
            const display = document.getElementById('districts_sum_display');
            if (display) {
                display.textContent = new Intl.NumberFormat('id-ID').format(sum);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleTypeFields();
            calculateDistrictsSum();
        });
    </script>
@endsection
