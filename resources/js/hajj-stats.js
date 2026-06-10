import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

const palette = [
    '#b8860b', '#0d9a8c', '#6d7c1e', '#d4af37', '#0a7a6f',
    '#8b6914', '#4ec4b8', '#a8c03a', '#6b4f0a', '#14b8a6',
    '#c9a227', '#5c6b18',
];

function readData() {
    const el = document.getElementById('hajj-chart-data');
    if (!el) return null;
    try {
        return JSON.parse(el.textContent);
    } catch {
        return null;
    }
}

function baseOptions(title) {
    return {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    font: { family: 'Poppins', size: 11 },
                    color: '#333',
                },
            },
            tooltip: {
                titleFont: { family: 'Poppins' },
                bodyFont: { family: 'Poppins' },
            },
        },
    };
}

function initMonthly(data) {
    const canvas = document.getElementById('chart-monthly');
    if (!canvas || !data?.monthly) return;

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: data.monthly.labels,
            datasets: [{
                label: 'Pendaftar',
                data: data.monthly.values,
                backgroundColor: '#b8860b',
                borderColor: '#8b6914',
                borderWidth: 1,
                borderRadius: 6,
            }],
        },
        options: {
            ...baseOptions(),
            scales: {
                x: {
                    ticks: { font: { family: 'Poppins', size: 10 }, color: '#555' },
                    grid: { display: false },
                },
                y: {
                    beginAtZero: true,
                    ticks: { font: { family: 'Poppins', size: 11 }, color: '#555' },
                    grid: { color: 'rgba(0,0,0,0.06)' },
                },
            },
        },
    });
}

function initDoughnut(id, dataset) {
    const canvas = document.getElementById(id);
    if (!canvas || !dataset) return;

    new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: dataset.labels,
            datasets: [{
                data: dataset.values,
                backgroundColor: palette.slice(0, dataset.labels.length),
                borderWidth: 2,
                borderColor: '#fff',
            }],
        },
        options: {
            ...baseOptions(),
            cutout: '55%',
        },
    });
}

function initHorizontalBar(id, dataset) {
    const canvas = document.getElementById(id);
    if (!canvas || !dataset) return;

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: dataset.labels,
            datasets: [{
                label: 'Jumlah',
                data: dataset.values,
                backgroundColor: palette.slice(0, dataset.labels.length),
                borderRadius: 4,
            }],
        },
        options: {
            indexAxis: 'y',
            ...baseOptions(),
            plugins: {
                ...baseOptions().plugins,
                legend: { display: false },
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { font: { family: 'Poppins', size: 11 }, color: '#555' },
                    grid: { color: 'rgba(0,0,0,0.06)' },
                },
                y: {
                    ticks: { font: { family: 'Poppins', size: 10 }, color: '#333' },
                    grid: { display: false },
                },
            },
        },
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const data = readData();
    if (!data) return;

    initMonthly(data);
    initDoughnut('chart-gender', data.gender);
    initDoughnut('chart-education', data.education);
    initHorizontalBar('chart-occupation', data.occupation);
    initHorizontalBar('chart-age', data.age);
});
