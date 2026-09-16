@extends('admin.layout')

@section('title', 'Data Jemaah Haji')

@section('content')
    <h2 style="margin-top:0;">Data Jemaah Haji Reguler</h2>
    <p style="color:#5c6b66;margin-bottom:20px;">Kelola data statistik yang ditampilkan di beranda website.</p>

    <form method="POST" action="{{ route('admin.hajj-stats.update') }}">
        @csrf
        @method('PUT')

        <div class="admin-card">
            <h2>Informasi Umum</h2>
            <div class="form-row">
                <div class="form-group">
                    <label for="data_date">Tanggal data</label>
                    <input type="date" id="data_date" name="data_date" value="{{ old('data_date', $stat->data_date?->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label for="total_registrants">Total pendaftar</label>
                    <input type="number" id="total_registrants" name="total_registrants" value="{{ old('total_registrants', $stat->total_registrants ?? 0) }}" min="0" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="elderly_count">Jemaah lansia</label>
                    <input type="number" id="elderly_count" name="elderly_count" value="{{ old('elderly_count', $stat->elderly_count ?? 0) }}" min="0" required>
                </div>
                <div class="form-group">
                    <label for="waiting_period">Masa tunggu</label>
                    <input type="text" id="waiting_period" name="waiting_period" value="{{ old('waiting_period', $stat->waiting_period) }}" placeholder="Contoh: 8 Tahun 4 Bulan" required>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" id="is_published" name="is_published" value="1" @checked(old('is_published', $stat->is_published ?? true))>
                <label for="is_published" style="margin:0;">Tampilkan di website</label>
            </div>
        </div>

        <div class="admin-card">
            <h2>Jumlah Pendaftar Per Bulan</h2>
            <div class="form-row--3cols">
                @foreach (App\Models\HajjStat::MONTHS as $month)
                    <div class="form-group">
                        <label for="month_{{ $month }}">{{ $month }}</label>
                        <input type="number" id="month_{{ $month }}" name="monthly_registrants[{{ $month }}]"
                            value="{{ old('monthly_registrants.'.$month, $stat->monthly_registrants[$month] ?? 0) }}" min="0">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="admin-card">
            <h2>Pengelompokan Jenis Kelamin</h2>
            <div class="form-row">
                @foreach (App\Models\HajjStat::GENDERS as $gender)
                    <div class="form-group">
                        <label for="gender_{{ $gender }}">{{ $gender }}</label>
                        <input type="number" id="gender_{{ $gender }}" name="gender[{{ $gender }}]"
                            value="{{ old('gender.'.$gender, $stat->gender[$gender] ?? 0) }}" min="0">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="admin-card">
            <h2>Pengelompokan Pekerjaan</h2>
            <div class="form-row--3cols">
                @foreach (App\Models\HajjStat::OCCUPATIONS as $occupation)
                    <div class="form-group">
                        <label for="occ_{{ Str::slug($occupation) }}">{{ $occupation }}</label>
                        <input type="number" id="occ_{{ Str::slug($occupation) }}" name="occupation[{{ $occupation }}]"
                            value="{{ old('occupation.'.$occupation, $stat->occupation[$occupation] ?? 0) }}" min="0">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="admin-card">
            <h2>Pengelompokan Pendidikan</h2>
            <div class="form-row">
                @foreach (App\Models\HajjStat::EDUCATIONS as $education)
                    <div class="form-group">
                        <label for="edu_{{ $education }}">{{ $education }}</label>
                        <input type="number" id="edu_{{ $education }}" name="education[{{ $education }}]"
                            value="{{ old('education.'.$education, $stat->education[$education] ?? 0) }}" min="0">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="admin-card">
            <h2>Pengelompokan Umur</h2>
            <div class="form-row--3cols">
                @foreach (App\Models\HajjStat::AGE_GROUPS as $age)
                    <div class="form-group">
                        <label for="age_{{ $age }}">{{ $age }} tahun</label>
                        <input type="number" id="age_{{ $age }}" name="age[{{ $age }}]"
                            value="{{ old('age.'.$age, $stat->age[$age] ?? 0) }}" min="0">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
