@extends('layouts.master')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
  :root { --teal:#0f7c7c; --teal-light:#e6f4f4; --teal-mid:#1a9e9e; --navy:#0d2d45; --soft-white:#fafaf8; }
  body { font-family:'DM Sans',sans-serif; background:var(--soft-white); }

  .specialist-hero {
    background: linear-gradient(135deg, var(--teal-light) 0%, #d4eaea 100%);
    padding: 3rem 1.5rem; border-bottom: 1px solid #c9e4e4;
  }
  .back-link { display:inline-flex; align-items:center; gap:0.4rem; color:var(--teal); font-size:0.83rem; font-weight:600; text-decoration:none; margin-bottom:1.25rem; }
  .back-link:hover { text-decoration:underline; }
  .specialist-hero-label { font-size:0.72rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:var(--teal-mid); margin-bottom:0.5rem; }
  .specialist-hero h1 { font-family:'Playfair Display',serif; font-size:clamp(1.8rem,4vw,2.8rem); color:var(--navy); margin-bottom:0.4rem; }
  .specialist-hero p { color:#4b7a7a; font-size:0.95rem; }

  .therapist-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:1.5rem; }
  .therapist-card {
    background:#fff; border-radius:20px; overflow:hidden;
    box-shadow:0 4px 18px rgba(13,45,69,0.08); border:1px solid rgba(13,45,69,0.06);
    transition:transform 0.3s, box-shadow 0.3s; text-decoration:none; color:inherit; display:block;
  }
  .therapist-card:hover { transform:translateY(-5px); box-shadow:0 14px 34px rgba(13,45,69,0.13); }
  .therapist-card img { width:100%; height:200px; object-fit:cover; display:block; transition:transform 0.4s; }
  .therapist-card:hover img { transform:scale(1.04); }
  .therapist-card-body { padding:1.25rem; }
  .therapist-name { font-family:'Playfair Display',serif; font-size:1.08rem; color:var(--navy); margin-bottom:0.35rem; font-weight:700; }
  .therapist-fee { display:inline-flex; align-items:center; gap:0.35rem; background:#fff7ed; color:#d97706; padding:0.3rem 0.7rem; border-radius:8px; font-size:0.78rem; font-weight:700; margin-bottom:0.6rem; }
  .therapist-desc { color:#6b7280; font-size:0.82rem; line-height:1.65; }
  .card-footer { padding:0 1.25rem 1.25rem; }
  .view-btn { display:block; text-align:center; background:var(--teal-light); color:var(--teal); padding:0.6rem; border-radius:10px; font-size:0.83rem; font-weight:700; transition:background 0.2s, color 0.2s; }
  .therapist-card:hover .view-btn { background:var(--teal); color:#fff; }

  .pagination-wrap { margin-top:2.5rem; display:flex; justify-content:center; }

  @media(max-width:640px){
    .therapist-grid { grid-template-columns:repeat(2,1fr); gap:0.9rem; }
    .therapist-card img { height:140px; }
    .therapist-card-body { padding:0.9rem; }
  }
  @media(max-width:360px){
    .therapist-grid { grid-template-columns:1fr; }
  }
</style>

<div class="specialist-hero">
  <div style="max-width:1100px; margin:0 auto; padding:0 1rem;">
    <a href="{{ route('home') }}" class="back-link">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Back to Home
    </a>
    <div class="specialist-hero-label">Specialist Directory</div>
    <h1>{{ $specialists->name }} Therapists</h1>
    <p>Certified {{ $specialists->name }} specialists ready to guide your healing journey.</p>
  </div>
</div>

<div style="max-width:1100px; margin:3rem auto 4rem; padding:0 1.25rem;">
  <div class="therapist-grid">
    @foreach($therapists as $therapist)
    <a href="{{ route('viewtherapist', $therapist->id) }}" class="therapist-card">
      <img src="{{ asset('images/therapists/' . $therapist->photopath) }}" alt="{{ $therapist->name }}">
      <div class="therapist-card-body">
        <div class="therapist-name">{{ $therapist->name }}</div>
        <div class="therapist-fee">Rs. {{ $therapist->fee }}</div>
        <p class="therapist-desc">{{ Str::limit($therapist->description, 80) }}</p>
      </div>
      <div class="card-footer">
        <span class="view-btn">View Profile →</span>
      </div>
    </a>
    @endforeach
  </div>

  <div class="pagination-wrap">
    {{ $therapists->links() }}
  </div>
</div>

@endsection