@extends('layouts.master')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
  :root { --teal:#0f7c7c; --teal-light:#e6f4f4; --teal-mid:#1a9e9e; --navy:#0d2d45; --soft-white:#fafaf8; }
  body { font-family:'DM Sans',sans-serif; background:var(--soft-white); }

  /* ── HEADER ── */
  .search-header { background:linear-gradient(135deg,var(--teal-light),#d4eaea); padding:2.5rem 1.5rem; border-bottom:1px solid #c9e4e4; }
  .search-header-inner { max-width:1100px; margin:0 auto; }
  .search-label { font-size:0.72rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:var(--teal-mid); margin-bottom:0.4rem; }
  .search-header h1 { font-family:'Playfair Display',serif; font-size:clamp(1.6rem,4vw,2.4rem); color:var(--navy); margin-bottom:0.4rem; }
  .search-header p { color:#4b7a7a; font-size:0.9rem; }

  /* ── FILTER PANEL ── */
  .filter-panel {
    background:#fff;
    border:1px solid #c9e4e4;
    border-radius:20px;
    padding:1.75rem 2rem;
    margin-bottom:2.5rem;
    box-shadow:0 4px 18px rgba(13,45,69,0.07);
  }
  .filter-panel h3 {
    font-family:'Playfair Display',serif;
    font-size:1.05rem;
    color:var(--navy);
    margin-bottom:1.1rem;
    display:flex;
    align-items:center;
    gap:0.5rem;
  }
  .filter-panel h3 i { color:var(--teal-mid); }

  .filter-row {
    display:grid;
    grid-template-columns:1fr 1fr auto;
    gap:1rem;
    align-items:end;
  }

  .filter-group label {
    display:block;
    font-size:0.72rem;
    font-weight:700;
    letter-spacing:0.09em;
    text-transform:uppercase;
    color:#374151;
    margin-bottom:0.4rem;
  }
  .filter-group input {
    width:100%;
    padding:0.72rem 1rem;
    border:1.5px solid #e5e7eb;
    border-radius:11px;
    font-size:0.88rem;
    font-family:'DM Sans',sans-serif;
    color:#1f2937;
    background:var(--soft-white);
    outline:none;
    transition:border-color 0.2s, box-shadow 0.2s;
  }
  .filter-group input:focus {
    border-color:var(--teal-mid);
    box-shadow:0 0 0 3px rgba(26,158,158,0.15);
    background:#fff;
  }

  .filter-btn {
    padding:0.72rem 1.5rem;
    background:var(--navy);
    color:#fff;
    border:none;
    border-radius:11px;
    font-size:0.88rem;
    font-weight:700;
    font-family:'DM Sans',sans-serif;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    gap:0.4rem;
    white-space:nowrap;
    transition:background 0.2s, transform 0.15s;
  }
  .filter-btn:hover { background:var(--teal); transform:translateY(-1px); }

  .filter-reset {
    display:inline-flex;
    align-items:center;
    gap:0.35rem;
    font-size:0.8rem;
    color:#6b7280;
    text-decoration:none;
    margin-top:0.75rem;
    transition:color 0.2s;
  }
  .filter-reset:hover { color:var(--teal); }

  /* Active filter badge */
  .active-filter-badge {
    display:inline-flex;
    align-items:center;
    gap:0.5rem;
    background:#e6f4f4;
    border:1px solid #a7d9d9;
    color:var(--teal);
    border-radius:999px;
    padding:0.4rem 1rem;
    font-size:0.8rem;
    font-weight:600;
    margin-bottom:1.25rem;
  }
  .active-filter-badge i { font-size:0.9rem; }

  /* Validation error */
  .filter-error { color:#ef4444; font-size:0.78rem; margin-top:0.35rem; }

  /* ── SECTION HEADING ── */
  .section-heading { font-family:'Playfair Display',serif; font-size:1.5rem; color:var(--navy); display:flex; align-items:center; gap:0.75rem; margin-bottom:1.5rem; }
  .section-heading::before { content:''; display:inline-block; width:4px; height:1.5rem; background:var(--teal); border-radius:2px; flex-shrink:0; }

  /* ── THERAPIST CARDS ── */
  .therapist-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:1.25rem; }
  .t-card { background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 3px 14px rgba(13,45,69,0.08); border:1px solid rgba(13,45,69,0.06); transition:transform 0.3s, box-shadow 0.3s; text-decoration:none; color:inherit; display:block; }
  .t-card:hover { transform:translateY(-4px); box-shadow:0 12px 28px rgba(13,45,69,0.13); }
  .t-card img { width:100%; height:180px; object-fit:cover; display:block; }
  .t-card-body { padding:1rem; }
  .t-card-name { font-family:'Playfair Display',serif; font-size:1rem; color:var(--navy); margin-bottom:0.35rem; }
  .t-card-desc { color:#6b7280; font-size:0.8rem; line-height:1.6; margin-bottom:0.8rem; }
  .t-view-btn { display:inline-block; background:var(--navy); color:#fff; padding:0.45rem 1rem; border-radius:8px; font-size:0.78rem; font-weight:600; }

  /* Availability tag on card */
  .t-avail-tag {
    display:inline-flex;
    align-items:center;
    gap:0.3rem;
    font-size:0.7rem;
    font-weight:700;
    color:#166534;
    background:#d1fae5;
    border-radius:6px;
    padding:0.25rem 0.6rem;
    margin-bottom:0.6rem;
  }
  .t-avail-tag i { font-size:0.75rem; }

  /* ── VIDEO CARDS ── */
  .video-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:1.25rem; }
  .v-card { background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 3px 14px rgba(13,45,69,0.08); border:1px solid rgba(13,45,69,0.06); transition:transform 0.3s; }
  .v-card:hover { transform:translateY(-4px); }
  .v-wrap { position:relative; padding-top:56.25%; }
  .v-wrap iframe { position:absolute; inset:0; width:100%; height:100%; border:none; }
  .v-body { padding:1rem; }
  .v-title { font-family:'Playfair Display',serif; font-size:0.95rem; color:var(--navy); margin-bottom:0.35rem; }
  .v-desc { color:#6b7280; font-size:0.78rem; line-height:1.6; margin-bottom:0.8rem; }
  .v-watch { display:inline-flex; align-items:center; gap:0.35rem; background:var(--teal); color:#fff; padding:0.45rem 1rem; border-radius:8px; font-size:0.78rem; font-weight:600; text-decoration:none; }

  /* ── SPECIALIST PILLS ── */
  .spec-grid { display:flex; flex-wrap:wrap; gap:0.75rem; }
  .spec-pill { display:inline-flex; align-items:center; gap:0.4rem; background:#fff; border:1.5px solid #c9e4e4; color:var(--navy); padding:0.6rem 1.2rem; border-radius:999px; font-size:0.85rem; font-weight:600; text-decoration:none; transition:all 0.2s; box-shadow:0 2px 8px rgba(13,45,69,0.06); }
  .spec-pill:hover { background:var(--teal); color:#fff; border-color:var(--teal); box-shadow:0 6px 20px rgba(15,124,124,0.3); }

  /* ── NO RESULTS ── */
  .no-results { display:flex; flex-direction:column; align-items:center; justify-content:center; padding:4rem 2rem; background:#fff; border-radius:20px; box-shadow:0 4px 18px rgba(13,45,69,0.07); text-align:center; }
  .no-results-icon { font-size:3.5rem; margin-bottom:1.25rem; }
  .no-results h3 { font-family:'Playfair Display',serif; font-size:1.4rem; color:var(--navy); margin-bottom:0.5rem; }
  .no-results p { color:#6b7280; font-size:0.9rem; max-width:360px; line-height:1.7; }

  @media(max-width:640px){
    .filter-row { grid-template-columns:1fr 1fr; }
    .filter-btn { grid-column:1/-1; width:100%; justify-content:center; }
    .therapist-grid { grid-template-columns:repeat(2,1fr); gap:0.85rem; }
    .t-card img { height:130px; }
    .video-grid { grid-template-columns:1fr; }
  }
  @media(max-width:360px){
    .therapist-grid { grid-template-columns:1fr; }
    .filter-row { grid-template-columns:1fr; }
  }
</style>

<div class="search-header">
  <div class="search-header-inner">
    <div class="search-label">Search Results</div>
    <h1>What We Found For You</h1>
    <p>Explore therapists, mindfulness activities, and specialists matching your search.</p>
  </div>
</div>

<div style="max-width:1100px; margin:3rem auto 4rem; padding:0 1.25rem;">

  {{-- ── AVAILABILITY FILTER PANEL ── --}}
  <div class="filter-panel">
    <h3><i class="ri-calendar-search-line"></i> Filter by Availability</h3>

    @if ($errors->any())
      <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:10px; padding:0.75rem 1rem; margin-bottom:1rem; font-size:0.82rem; color:#b91c1c;">
        @foreach ($errors->all() as $error)• {{ $error }}<br>@endforeach
      </div>
    @endif

    <form method="GET" action="{{ route('search') }}">
      <div class="filter-row">
        <div class="filter-group">
          <label for="search_date">Date</label>
          <input
            type="date"
            name="search_date"
            id="search_date"
            min="{{ now()->toDateString() }}"
            value="{{ request('search_date') }}"
          >
        </div>
        <div class="filter-group">
          <label for="search_time">Time</label>
          <input
            type="time"
            name="search_time"
            id="search_time"
            value="{{ request('search_time') }}"
          >
        </div>
        <div>
          <button type="submit" class="filter-btn">
            <i class="ri-search-line"></i> Find Available
          </button>
        </div>
      </div>
    </form>

    @if(request('search_date') && request('search_time'))
      <a href="{{ route('search') }}" class="filter-reset">
        <i class="ri-close-circle-line"></i> Clear filter
      </a>
    @endif
  </div>

  {{-- ── ACTIVE FILTER BADGE ── --}}
  @if(isset($date) && $date && isset($time) && $time)
  <div class="active-filter-badge">
    <i class="ri-filter-3-line"></i>
    Showing therapists available on
    <strong>{{ \Carbon\Carbon::parse($date)->format('D, M j') }}</strong>
    at
    <strong>{{ \Carbon\Carbon::parse($time)->format('h:i A') }}</strong>
    — {{ $therapists->count() }} found
  </div>
  @endif

  @php $hasResults = $therapists->isNotEmpty() || $activities->isNotEmpty() || $specialists->isNotEmpty(); @endphp

  @if($hasResults)

    {{-- Therapists --}}
    @if($therapists->isNotEmpty())
    <section style="margin-bottom:3.5rem;">
      <h2 class="section-heading">Therapists</h2>
      <div class="therapist-grid">
        @foreach($therapists as $therapist)
        <a href="{{ route('viewtherapist', $therapist->id) }}" class="t-card">
          <img src="{{ asset('images/therapists/' . $therapist->photopath) }}" alt="{{ $therapist->name }}">
          <div class="t-card-body">

            {{-- Show availability tag only when filtering by date/time --}}
            @if(isset($date) && $date)
            <div class="t-avail-tag">
              <i class="ri-checkbox-circle-line"></i>
              Available {{ \Carbon\Carbon::parse($date)->format('D') }} at {{ \Carbon\Carbon::parse($time)->format('h:i A') }}
            </div>
            @endif

            <div class="t-card-name">{{ $therapist->name }}</div>
            <p class="t-card-desc">{{ Str::limit($therapist->description, 90) }}</p>
            <span class="t-view-btn">View Profile →</span>
          </div>
        </a>
        @endforeach
      </div>
    </section>
    @endif

    {{-- Activities (only shown for keyword search, not availability filter) --}}
    @if($activities->isNotEmpty())
    <section style="margin-bottom:3.5rem;">
      <h2 class="section-heading">Mindfulness Activities</h2>
      <div class="video-grid">
        @foreach($activities as $activity)
        <div class="v-card">
          <div class="v-wrap"><iframe src="{{ $activity->video_url }}" frameborder="0" allowfullscreen></iframe></div>
          <div class="v-body">
            <div class="v-title">{{ $activity->title }}</div>
            <p class="v-desc">{{ Str::limit($activity->description, 90) }}</p>
            <a href="{{ $activity->video_url }}" target="_blank" class="v-watch">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
              Watch Now
            </a>
          </div>
        </div>
        @endforeach
      </div>
    </section>
    @endif

    {{-- Specialists --}}
    @if($specialists->isNotEmpty())
    <section>
      <h2 class="section-heading">Specialists</h2>
      <div class="spec-grid">
        @foreach($specialists as $specialist)
        <a href="{{ route('specialisttherapist', $specialist->id) }}" class="spec-pill">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          {{ $specialist->name }}
        </a>
        @endforeach
      </div>
    </section>
    @endif

  @else
    <div class="no-results">
      <div class="no-results-icon">
        @if(isset($date) && $date) 📅 @else 🔍 @endif
      </div>
      <h3>No Results Found</h3>
      <p>
        @if(isset($date) && $date)
          No therapists are available on <strong>{{ \Carbon\Carbon::parse($date)->format('l, M j') }}</strong>
          at <strong>{{ \Carbon\Carbon::parse($time)->format('h:i A') }}</strong>.
          Try a different date or time.
        @else
          We couldn't find anything matching your search. Try different keywords or explore our therapists and activities.
        @endif
      </p>
      <a href="{{ route('home') }}" style="margin-top:1.5rem; display:inline-flex; align-items:center; gap:0.4rem; background:var(--teal); color:#fff; padding:0.75rem 1.75rem; border-radius:999px; font-weight:600; text-decoration:none; font-size:0.9rem;">
        ← Back to Home
      </a>
    </div>
  @endif

</div>
@endsection