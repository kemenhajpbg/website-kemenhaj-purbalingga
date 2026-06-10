@if ($hajjStat)
<section class="hajj-stats-section" id="data-jemaah">
    <div class="container">
        <div class="hajj-stats-header">
            <h2 class="hajj-stats-title">
                Data Total Jemaah Haji Reguler
                <span>Per Tanggal {{ $hajjStat->data_date->translatedFormat('d F Y') }}</span>
            </h2>
        </div>

        <div class="hajj-stats-summary">
            <div class="hajj-stat-card hajj-stat-card--total">
                <span class="hajj-stat-label">Total Pendaftar</span>
                <strong class="hajj-stat-value">{{ number_format($hajjStat->total_registrants, 0, ',', '.') }}</strong>
            </div>
            <div class="hajj-stat-card">
                <span class="hajj-stat-label">Jemaah Lansia</span>
                <strong class="hajj-stat-value">{{ number_format($hajjStat->elderly_count, 0, ',', '.') }}</strong>
            </div>
            <div class="hajj-stat-card hajj-stat-card--wait">
                <span class="hajj-stat-label">Masa Tunggu</span>
                <strong class="hajj-stat-value hajj-stat-value--text">{{ $hajjStat->waiting_period }}</strong>
            </div>
        </div>

        <div class="hajj-chart-panel hajj-chart-panel--wide">
            <h3 class="hajj-chart-title">Jumlah Pendaftar Per Bulan</h3>
            <div class="hajj-chart-wrap">
                <canvas id="chart-monthly" aria-label="Grafik pendaftar per bulan"></canvas>
            </div>
        </div>

        <div class="hajj-charts-grid">
            <div class="hajj-chart-panel">
                <h3 class="hajj-chart-title">Pengelompokan Jenis Kelamin</h3>
                <div class="hajj-chart-wrap hajj-chart-wrap--doughnut">
                    <canvas id="chart-gender" aria-label="Grafik jenis kelamin"></canvas>
                </div>
            </div>
            <div class="hajj-chart-panel">
                <h3 class="hajj-chart-title">Pengelompokan Pendidikan</h3>
                <div class="hajj-chart-wrap hajj-chart-wrap--doughnut">
                    <canvas id="chart-education" aria-label="Grafik pendidikan"></canvas>
                </div>
            </div>
            <div class="hajj-chart-panel hajj-chart-panel--wide">
                <h3 class="hajj-chart-title">Pengelompokan Pekerjaan</h3>
                <div class="hajj-chart-wrap">
                    <canvas id="chart-occupation" aria-label="Grafik pekerjaan"></canvas>
                </div>
            </div>
            <div class="hajj-chart-panel hajj-chart-panel--wide">
                <h3 class="hajj-chart-title">Pengelompokan Umur</h3>
                <div class="hajj-chart-wrap">
                    <canvas id="chart-age" aria-label="Grafik umur"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script type="application/json" id="hajj-chart-data">@json($hajjStat->chartPayload())</script>
</section>
@endif
