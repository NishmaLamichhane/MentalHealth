@extends('layouts.master')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
  :root { --blue:#2563eb; --blue-light:#eff6ff; --blue-mid:#3b82f6; --navy:#0d2d45; --soft-white:#fafaf8; }
  body { font-family:'DM Sans',sans-serif; background:var(--soft-white); }

  .progress-header { background:linear-gradient(135deg,var(--navy),#174a6e); padding:2.5rem 1.5rem; }
  .progress-header-inner { max-width:1000px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; }
  .progress-header h1 { font-family:'Playfair Display',serif; font-size:clamp(1.5rem,4vw,2rem); color:#fff; }
  .progress-header p { color:rgba(255,255,255,0.6); font-size:0.85rem; margin-top:0.25rem; }
  .add-btn { display:inline-flex; align-items:center; gap:0.5rem; background:linear-gradient(135deg,#3b82f6,#2563eb); color:#fff; padding:0.7rem 1.5rem; border-radius:999px; font-weight:700; font-size:0.88rem; text-decoration:none; box-shadow:0 6px 20px rgba(37,99,235,0.35); transition:transform 0.2s, box-shadow 0.2s; white-space:nowrap; }
  .add-btn:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(37,99,235,0.45); }

  .table-card { background:#fff; border-radius:20px; overflow:hidden; box-shadow:0 4px 20px rgba(13,45,69,0.08); border:1px solid rgba(13,45,69,0.06); }
  .table-card table { width:100%; border-collapse:collapse; }
  .table-card thead { background:var(--blue-light); }
  .table-card th { padding:0.9rem 1.25rem; text-align:left; font-size:0.72rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:var(--blue-mid); }
  .table-card td { padding:1rem 1.25rem; font-size:0.88rem; color:#374151; border-bottom:1px solid #f0f0ee; vertical-align:middle; }
  .table-card tbody tr:last-child td { border-bottom:none; }
  .table-card tbody tr:hover { background:#fafaf8; }
  .date-badge { display:inline-flex; align-items:center; gap:0.35rem; background:var(--blue-light); color:var(--blue-mid); padding:0.3rem 0.7rem; border-radius:8px; font-size:0.78rem; font-weight:600; white-space:nowrap; }
  .progress-title-cell { font-weight:600; color:var(--navy); }
  .edit-link { color:var(--blue-mid); font-weight:600; font-size:0.83rem; text-decoration:none; }
  .edit-link:hover { text-decoration:underline; }
  .delete-btn { background:none; border:none; color:#ef4444; font-weight:600; font-size:0.83rem; cursor:pointer; padding:0; }
  .delete-btn:hover { text-decoration:underline; }

  /* Mobile table scroll */
  .table-scroll { overflow-x:auto; -webkit-overflow-scrolling:touch; }

  /* Chart card */
  .chart-card { background:#fff; border-radius:20px; padding:1.75rem; box-shadow:0 4px 20px rgba(13,45,69,0.08); border:1px solid rgba(13,45,69,0.06); margin-top:2rem; }
  .chart-card h2 { font-family:'Playfair Display',serif; font-size:1.25rem; color:var(--navy); margin-bottom:1.25rem; }

  .pagination-wrap { margin-top:1.25rem; }

  @media(max-width:640px){
    .progress-header { padding:2rem 1rem; }
    .table-card th, .table-card td { padding:0.75rem 0.9rem; }
    .chart-card { padding:1.25rem; }
  }
</style>

<div class="progress-header">
  <div class="progress-header-inner">
    <div>
      <h1>My Progress Journal</h1>
      <p>Track your mental health milestones over time.</p>
    </div>
    <a href="{{ route('user_progress.create') }}" class="add-btn">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Add Progress
    </a>
  </div>
</div>

<div style="max-width:1000px; margin:2.5rem auto 4rem; padding:0 1.25rem;">

  @if (session('success'))
    <div style="background:#dbeafe; border:1px solid #93c5fd; color:#1e40af; padding:0.85rem 1.25rem; border-radius:12px; margin-bottom:1.5rem; font-size:0.88rem; font-weight:500;">
      ✅ {{ session('success') }}
    </div>
  @endif

  <div class="table-card">
    <div class="table-scroll">
      <table>
        <thead>
          <tr>
            <th>Date</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($progress as $item)
          <tr>
            <td><span class="date-badge">📅 {{ $item->progress_date }}</span></td>
            <td class="progress-title-cell">{{ $item->progress_title }}</td>
            <td style="color:#6b7280;">{{ $item->description }}</td>
            <td>
              <div style="display:flex; gap:1rem; align-items:center;">
                <a href="{{ route('user_progress.edit', $item->id) }}" class="edit-link">✏️ Edit</a>
                <form action="{{ route('user_progress.destroy', $item->id) }}" method="POST" style="display:inline;">
                  @csrf @method('DELETE')
                  <button type="submit" class="delete-btn" onclick="return confirm('Delete this progress entry?')">🗑 Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" style="text-align:center; padding:2.5rem; color:#9ca3af;">
              No progress entries yet. <a href="{{ route('user_progress.create') }}" style="color:var(--blue-mid); font-weight:600;">Add your first one →</a>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="pagination-wrap">{{ $progress->links() }}</div>

  {{-- Chart --}}
  <div class="chart-card">
    <h2>📊 Progress Overview</h2>
    <canvas id="barChart" style="width:100%; max-height:300px;"></canvas>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('barChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json($dataCounts->keys()),
      datasets: [{
        label: 'Progress Entries',
        data: @json($dataCounts->values()),
        backgroundColor: 'rgba(59, 130, 246, 0.15)',
        borderColor: 'rgba(37, 99, 235, 1)',
        borderWidth: 2,
        borderRadius: 8,
        borderSkipped: false,
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color:'#6b7280', font:{size:12} } },
        y: { beginAtZero: true, grid: { color:'#f0f0ee' }, ticks: { color:'#6b7280', font:{size:12}, stepSize:1 } }
      }
    }
  });
</script>
@endsection