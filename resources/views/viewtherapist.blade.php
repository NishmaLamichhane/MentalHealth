@extends('layouts.master')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
  :root {
    --teal: #0f7c7c; --teal-light: #e6f4f4; --teal-mid: #1a9e9e;
    --navy: #0d2d45; --gold: #c9974a; --soft-white: #fafaf8;
  }
  body { font-family: 'DM Sans', sans-serif; background: var(--soft-white); }
  .display-font { font-family: 'Playfair Display', serif; }

  /* Breadcrumb */
  .breadcrumb { display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; color: #9ca3af; margin-bottom: 2rem; }
  .breadcrumb a { color: var(--teal); text-decoration: none; }
  .breadcrumb a:hover { text-decoration: underline; }

  /* Profile hero */
  .profile-hero { display: grid; grid-template-columns: 1fr 340px; gap: 2.5rem; align-items: start; }
  .profile-card { background: #fff; border-radius: 24px; padding: 2.5rem; box-shadow: 0 4px 30px rgba(13,45,69,0.09); border: 1px solid rgba(13,45,69,0.07); }
  .profile-photo-card { background: #fff; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 30px rgba(13,45,69,0.09); border: 1px solid rgba(13,45,69,0.07); position: sticky; top: 2rem; }
  .profile-photo-card img { width: 100%; height: 380px; object-fit: cover; display: block; }
  .photo-card-body { padding: 1.5rem; }
  .photo-card-body .name { font-family: 'Playfair Display', serif; font-size: 1.3rem; color: var(--navy); margin-bottom: 0.3rem; }
  .photo-card-body .spec-tag {
    display: inline-block; background: var(--teal-light); color: var(--teal);
    padding: 0.3rem 0.9rem; border-radius: 999px; font-size: 0.78rem; font-weight: 600; margin-bottom: 1rem;
  }
  .book-btn {
    display: block; text-align: center;
    background: linear-gradient(135deg, var(--teal-mid), var(--teal));
    color: white; padding: 0.9rem; border-radius: 12px;
    font-weight: 700; font-size: 1rem; text-decoration: none;
    box-shadow: 0 6px 20px rgba(15,124,124,0.35);
    transition: transform 0.2s, box-shadow 0.2s;
  }
  .book-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(15,124,124,0.45); }

  .therapist-name { font-family: 'Playfair Display', serif; font-size: 2.2rem; color: var(--navy); margin-bottom: 0.4rem; }
  .info-section { margin-bottom: 1.8rem; padding-bottom: 1.8rem; border-bottom: 1px solid #f0f0ee; }
  .info-section:last-of-type { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
  .info-label { font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--teal-mid); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.4rem; }
  .info-label svg { width: 14px; height: 14px; }
  .info-text { color: #374151; font-size: 0.95rem; line-height: 1.75; }
  .info-badge { display: inline-flex; align-items: center; gap: 0.4rem; background: #fff7ed; color: var(--gold); border: 1px solid #fde8c0; padding: 0.45rem 1rem; border-radius: 10px; font-weight: 700; font-size: 1rem; }

  /* Quote block */
  .quote-block {
    background: linear-gradient(135deg, var(--navy) 0%, #174a6e 100%);
    border-radius: 20px; padding: 2.5rem; margin-top: 2.5rem; text-align: center;
  }
  .quote-block h3 { font-family: 'Playfair Display', serif; color: #fff; font-size: 1.3rem; margin-bottom: 0.75rem; }
  .quote-block p { color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 1rem; line-height: 1.7; }
  .quote-block blockquote { font-style: italic; color: #93c5d8; font-size: 0.9rem; line-height: 1.8; border-left: 3px solid var(--teal-mid); padding-left: 1.25rem; text-align: left; }

  /* Related section */
  .related-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.25rem; }
  .related-card { background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid rgba(13,45,69,0.07); box-shadow: 0 2px 14px rgba(13,45,69,0.06); transition: transform 0.3s, box-shadow 0.3s; text-decoration: none; display: block; color: inherit; }
  .related-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(13,45,69,0.12); }
  .related-card img { width: 100%; height: 160px; object-fit: cover; display: block; }
  .related-card-body { padding: 1rem; }
  .related-card-name { font-family: 'Playfair Display', serif; font-size: 1rem; color: var(--navy); margin-bottom: 0.35rem; }
  .related-card-desc { color: #6b7280; font-size: 0.8rem; line-height: 1.6; }

  /* Mobile */
  @media (max-width: 768px) {
    .profile-hero { grid-template-columns: 1fr; }
    .profile-photo-card { position: static; }
    .profile-photo-card img { height: 260px; }
    .therapist-name { font-size: 1.7rem; }
    .related-grid { grid-template-columns: repeat(2, 1fr); gap: 0.9rem; }
    .related-card img { height: 120px; }
    .quote-block { padding: 1.75rem 1.25rem; }
  }
  @media (max-width: 480px) {
    .related-grid { grid-template-columns: 1fr; }
    .profile-card { padding: 1.5rem; }
  }
</style>

<div style="background: linear-gradient(180deg, #e9f5f5 0%, var(--soft-white) 100%); min-height: 100vh;">
<div style="max-width:1100px; margin:0 auto; padding: 2.5rem 1.25rem 4rem;">

  {{-- Breadcrumb --}}
  <div class="breadcrumb">
    <a href="{{ route('home') }}">Home</a>
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
    <a href="{{ route('home') }}#therapists">Therapists</a>
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
    <span>{{ $therapist->name }}</span>
  </div>

  {{-- Profile Hero --}}
  <div class="profile-hero">

    {{-- Left: Info Card --}}
    <div class="profile-card">
      <h1 class="therapist-name">{{ $therapist->name }}</h1>
      <div style="margin-bottom:2rem; display:flex; flex-wrap:wrap; gap:0.5rem; align-items:center;">
        <span style="display:inline-block; background:var(--teal-light); color:var(--teal); padding:0.3rem 0.9rem; border-radius:999px; font-size:0.78rem; font-weight:600;">{{ $therapist->specialization ?? 'Therapist' }}</span>
        <span style="display:inline-block; background:#fef3c7; color:#d97706; padding:0.3rem 0.9rem; border-radius:999px; font-size:0.78rem; font-weight:600;">⭐ Verified Professional</span>
      </div>

      <div class="info-section">
        <div class="info-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          About
        </div>
        <p class="info-text">{{ $therapist->description }}</p>
      </div>

      <div class="info-section">
        <div class="info-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          Experience
        </div>
        <p class="info-text">{{ $therapist->experience }}</p>
      </div>

      <div class="info-section" style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
        <div>
          <div class="info-label">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"></svg>
            Consultation Fee
          </div>
          <div class="info-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"></svg>
            Rs. {{ $therapist->fee }}
          </div>
        </div>
        <div>
          <div class="info-label">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Location
          </div>
          <p class="info-text" style="font-weight:500; color:var(--navy);">{{ $therapist->location }}</p>
        </div>
      </div>

      {{-- Mobile Book Button --}}
      <div style="margin-top:2rem; display:none;" class="mobile-book">
        <a href="{{ route('bookings.create', $therapist->id) }}" class="book-btn">Book an Appointment</a>
      </div>
    </div>

    {{-- Right: Photo Card --}}
    <div class="profile-photo-card">
      <img src="{{ asset('images/therapists/' . $therapist->photopath) }}" alt="{{ $therapist->name }}">
      <div class="photo-card-body">
        <div class="name">{{ $therapist->name }}</div>
        <div class="spec-tag">{{ $therapist->specialization ?? 'Mental Health' }}</div>
        <a href="{{ route('bookings.create', $therapist->id) }}" class="book-btn">
          📅 Book an Appointment
        </a>
      </div>
    </div>

  </div>

  {{-- Quote Block --}}
  <div class="quote-block">
    <h3>Connect with {{ $therapist->name }}</h3>
    <p>Thank you for considering Dr. {{ $therapist->name }} for your mental health needs. Feel free to reach out for any inquiries or to schedule an appointment.</p>
    <blockquote>
      "Mental health is not a destination but a process. It's about how you drive, not where you're going."
    </blockquote>
  </div>

  {{-- Related Therapists --}}
  <section style="margin-top:4rem;">
    <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.75rem;">
      <div style="width:4px; height:2rem; background:var(--teal); border-radius:2px;"></div>
      <h2 style="font-family:'Playfair Display',serif; font-size:1.6rem; color:var(--navy);">Related Therapists</h2>
    </div>
    <div class="related-grid">
      @foreach($relatedtherapists as $rtherapist)
      <a href="{{ route('viewtherapist', $rtherapist->id) }}" class="related-card">
        <img src="{{ asset('images/therapists/' . $rtherapist->photopath) }}" alt="{{ $rtherapist->name }}">
        <div class="related-card-body">
          <div class="related-card-name">{{ $rtherapist->name }}</div>
          <p class="related-card-desc">{{ Str::limit($rtherapist->description, 85) }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </section>

</div>
</div>

<style>
  @media (max-width: 768px) {
    .mobile-book { display: block !important; }
    .profile-photo-card .book-btn { display: none !important; }
  }
</style>
@endsection