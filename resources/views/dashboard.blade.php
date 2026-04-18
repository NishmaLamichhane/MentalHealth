@extends('layouts.app')
@section('content')

<style>
    /* Stat cards */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: white; border-radius: 1.1rem;
        border: 1px solid #e2e8f0;
        padding: 1.4rem 1.5rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        display: flex; align-items: flex-start; gap: 1rem;
        transition: all 0.3s ease;
        position: relative; overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 0 0 1.1rem 1.1rem;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }

    .stat-card-blue::before   { background: linear-gradient(90deg, #3b82f6, #6366f1); }
    .stat-card-indigo::before { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
    .stat-card-amber::before  { background: linear-gradient(90deg, #f59e0b, #f97316); }
    .stat-card-green::before  { background: linear-gradient(90deg, #10b981, #059669); }
    .stat-card-red::before    { background: linear-gradient(90deg, #ef4444, #dc2626); }
    .stat-card-violet::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }

    .stat-icon {
        width: 48px; height: 48px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; flex-shrink: 0;
    }
    .stat-icon-blue   { background: #eff6ff; color: #3b82f6; }
    .stat-icon-indigo { background: #eef2ff; color: #6366f1; }
    .stat-icon-amber  { background: #fffbeb; color: #f59e0b; }
    .stat-icon-green  { background: #f0fdf4; color: #10b981; }
    .stat-icon-red    { background: #fef2f2; color: #ef4444; }
    .stat-icon-violet { background: #f5f3ff; color: #8b5cf6; }

    .stat-label {
        font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 4px;
    }
    .stat-value {
        font-family: 'Playfair Display', serif;
        font-size: 2rem; font-weight: 700; color: #0f172a;
        line-height: 1;
    }
    .dark .stat-card { background: #1e293b; border-color: #334155; }
    .dark .stat-value { color: #f1f5f9; }

    /* Bottom grid */
    .bottom-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 1.5rem;
    }
    .chart-card {
        background: white; border-radius: 1.1rem;
        border: 1px solid #e2e8f0;
        padding: 1.5rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .dark .chart-card { background: #1e293b; border-color: #334155; }
    .chart-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.1rem; font-weight: 700; color: #0f172a;
        margin-bottom: 0.25rem;
    }
    .dark .chart-title { color: #f1f5f9; }
    .chart-sub { font-size: 0.78rem; color: #94a3b8; margin-bottom: 1.5rem; }

    /* Quick stats legend */
    .legend-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .legend-item:last-child { border-bottom: none; }
    .legend-dot {
        width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0;
    }
    .legend-label { font-size: 0.83rem; color: #475569; font-weight: 500; }
    .legend-count { font-size: 0.9rem; font-weight: 700; color: #0f172a; }
    .dark .legend-count { color: #f1f5f9; }
    .dark .legend-item { border-color: #334155; }
    .dark .legend-label { color: #94a3b8; }

    @media (max-width: 900px) {
        .bottom-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 480px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .stat-value { font-size: 1.6rem; }
        .stat-icon { width: 40px; height: 40px; font-size: 1.1rem; }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-title-wrap">
        <div class="page-label">Overview</div>
        <h1 class="page-title">
            <i class="ri-dashboard-3-line"></i>
            Dashboard
        </h1>
    </div>
    <div style="font-size:0.8rem; color:#94a3b8;">
        <i class="ri-time-line mr-1"></i>
        {{ now()->format('l, F j Y') }}
    </div>
</div>

<!-- Stat Cards -->
<div class="stat-grid">
    <div class="stat-card stat-card-blue">
        <div class="stat-icon stat-icon-blue">
            <i class="ri-user-star-line"></i>
        </div>
        <div>
            <div class="stat-label">Specialities</div>
            <div class="stat-value">{{ $specialists }}</div>
        </div>
    </div>
    <div class="stat-card stat-card-indigo">
        <div class="stat-icon stat-icon-indigo">
            <i class="ri-psychotherapy-line"></i>
        </div>
        <div>
            <div class="stat-label">Therapists</div>
            <div class="stat-value">{{ $therapists }}</div>
        </div>
    </div>
    <div class="stat-card stat-card-amber">
        <div class="stat-icon stat-icon-amber">
            <i class="ri-timer-2-line"></i>
        </div>
        <div>
            <div class="stat-label">Pending</div>
            <div class="stat-value">{{ $pending }}</div>
        </div>
    </div>
    <div class="stat-card stat-card-green">
        <div class="stat-icon stat-icon-green">
            <i class="ri-check-double-line"></i>
        </div>
        <div>
            <div class="stat-label">Approved</div>
            <div class="stat-value">{{ $approved }}</div>
        </div>
    </div>
    <div class="stat-card stat-card-red">
        <div class="stat-icon stat-icon-red">
            <i class="ri-close-circle-line"></i>
        </div>
        <div>
            <div class="stat-label">Rejected</div>
            <div class="stat-value">{{ $rejected }}</div>
        </div>
    </div>
    <div class="stat-card stat-card-violet">
        <div class="stat-icon stat-icon-violet">
            <i class="ri-mental-health-line"></i>
        </div>
        <div>
            <div class="stat-label">Activities</div>
            <div class="stat-value">{{ $mindfulness }}</div>
        </div>
    </div>
</div>

<!-- Bottom: Chart + Legend -->
<div class="bottom-grid">
    <!-- Pie Chart -->
    <div class="chart-card">
        <div class="chart-title">Appointment Overview</div>
        <div class="chart-sub">Distribution of all appointment statuses</div>
        <div style="max-width: 320px; margin: 0 auto;">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <!-- Summary Legend -->
    <div class="chart-card">
        <div class="chart-title">Quick Summary</div>
        <div class="chart-sub">Snapshot of current platform data</div>

        <div class="legend-item">
            <div style="display:flex; align-items:center; gap:0.6rem;">
                <div class="legend-dot" style="background:#3b82f6;"></div>
                <span class="legend-label">Total Specialists</span>
            </div>
            <span class="legend-count">{{ $specialists }}</span>
        </div>
        <div class="legend-item">
            <div style="display:flex; align-items:center; gap:0.6rem;">
                <div class="legend-dot" style="background:#6366f1;"></div>
                <span class="legend-label">Total Therapists</span>
            </div>
            <span class="legend-count">{{ $therapists }}</span>
        </div>
        <div class="legend-item">
            <div style="display:flex; align-items:center; gap:0.6rem;">
                <div class="legend-dot" style="background:#f59e0b;"></div>
                <span class="legend-label">Pending Appointments</span>
            </div>
            <span class="legend-count">{{ $pending }}</span>
        </div>
        <div class="legend-item">
            <div style="display:flex; align-items:center; gap:0.6rem;">
                <div class="legend-dot" style="background:#10b981;"></div>
                <span class="legend-label">Approved Appointments</span>
            </div>
            <span class="legend-count">{{ $approved }}</span>
        </div>
        <div class="legend-item">
            <div style="display:flex; align-items:center; gap:0.6rem;">
                <div class="legend-dot" style="background:#ef4444;"></div>
                <span class="legend-label">Rejected Appointments</span>
            </div>
            <span class="legend-count">{{ $rejected }}</span>
        </div>
        <div class="legend-item">
            <div style="display:flex; align-items:center; gap:0.6rem;">
                <div class="legend-dot" style="background:#8b5cf6;"></div>
                <span class="legend-label">Mindfulness Activities</span>
            </div>
            <span class="legend-count">{{ $mindfulness }}</span>
        </div>

        <div style="margin-top:1.25rem; padding:1rem; background:#eff6ff; border-radius:0.75rem; border:1px solid #bfdbfe;">
            <p style="font-size:0.75rem; color:#1d4ed8; font-weight:600;">
                <i class="ri-bar-chart-2-line mr-1"></i>
                Approval Rate:
                <span style="font-size:1rem; font-family:'Playfair Display',serif;">
                    @php
                        $total = $pending + $approved + $rejected;
                        echo $total > 0 ? round(($approved / $total) * 100) . '%' : '—';
                    @endphp
                </span>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                data: [{{ $pending }}, {{ $approved }}, {{ $rejected }}],
                backgroundColor: ['#fef9c3', '#d1fae5', '#fee2e2'],
                borderColor: ['#f59e0b', '#10b981', '#ef4444'],
                borderWidth: 2,
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            cutout: '65%',
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: { font: { size: 12, family: 'DM Sans' }, padding: 16, usePointStyle: true }
                },
                tooltip: {
                    callbacks: {
                        label: function(item) {
                            let total = item.dataset.data.reduce((a,b)=>a+b,0);
                            let pct = total > 0 ? ((item.raw/total)*100).toFixed(1) : 0;
                            return ` ${item.label}: ${item.raw} (${pct}%)`;
                        }
                    }
                }
            }
        }
    });
</script>

@endsection