@extends('layouts.master')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap');

    /* ===== PAGE HERO ===== */
    .page-hero {
        position: relative;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 55%, #1e1b4b 100%);
        overflow: hidden;
        padding: 4rem 1.5rem 5.5rem;
    }
    .page-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .page-hero::after {
        content: '';
        position: absolute; bottom: -1px; left: 0; right: 0; height: 90px;
        background: linear-gradient(to top, #f8fafc, transparent);
    }
    .hero-orb {
        position: absolute; border-radius: 50%; filter: blur(60px); pointer-events: none;
        animation: floatOrb 7s ease-in-out infinite alternate;
    }
    @keyframes floatOrb {
        from { transform: translate(0,0) scale(1); }
        to { transform: translate(16px,-12px) scale(1.08); }
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(59,130,246,0.15); border: 1px solid rgba(96,165,250,0.25);
        color: #93c5fd; border-radius: 999px; padding: 5px 14px;
        font-size: 0.68rem; font-weight: 700; letter-spacing: 0.1em;
        text-transform: uppercase; margin-bottom: 0.85rem;
        backdrop-filter: blur(10px);
    }

    /* ===== BACK LINK ===== */
    .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: #93c5fd; font-size: 0.78rem; font-weight: 600;
        text-decoration: none; transition: color 0.2s ease;
        margin-bottom: 1.25rem;
    }
    .back-link:hover { color: #bfdbfe; }

    /* ===== SECTION CONTENT ===== */
    .section-bg { background: #f8fafc; min-height: 60vh; padding: 3rem 0 5rem; margin-top: -2px; }

    /* ===== THERAPIST GRID ===== */
    .therapist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 1.5rem;
    }

    /* ===== THERAPIST CARD ===== */
    .therapist-card {
        background: white; border-radius: 1.25rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 18px rgba(0,0,0,0.05);
        overflow: hidden; display: block; text-decoration: none; color: inherit;
        transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.3s ease, border-color 0.3s ease;
        opacity: 0; transform: translateY(20px);
        animation: cardIn 0.5s ease forwards;
    }
    @keyframes cardIn {
        to { opacity: 1; transform: translateY(0); }
    }
    .therapist-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(59,130,246,0.14);
        border-color: #bfdbfe;
    }

    /* Image wrapper */
    .card-img-wrap {
        position: relative; overflow: hidden;
        height: 200px; background: linear-gradient(135deg, #eff6ff, #eef2ff);
    }
    .card-img-wrap img {
        width: 100%; height: 100%; object-fit: cover; display: block;
        transition: transform 0.45s cubic-bezier(0.25,0.46,0.45,0.94);
    }
    .therapist-card:hover .card-img-wrap img { transform: scale(1.06); }

    /* Overlay badge on image */
    .img-fee-badge {
        position: absolute; top: 10px; right: 10px;
        background: rgba(15,23,42,0.75); backdrop-filter: blur(6px);
        color: #fbbf24; font-size: 0.73rem; font-weight: 700;
        padding: 4px 10px; border-radius: 8px;
        border: 1px solid rgba(251,191,36,0.25);
        letter-spacing: 0.02em;
    }

    /* Card body */
    .card-body { padding: 1.15rem 1.25rem; }
    .card-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem; font-weight: 700; color: #0f172a;
        margin-bottom: 0.35rem; line-height: 1.3;
    }
    .card-desc {
        font-size: 0.8rem; color: #64748b; line-height: 1.65;
        margin-bottom: 0; display: -webkit-box;
        -webkit-line-clamp: 3; -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Card footer */
    .card-footer {
        padding: 0 1.25rem 1.25rem;
    }
    .view-btn {
        display: flex; align-items: center; justify-content: center; gap: 7px;
        width: 100%; padding: 0.65rem;
        font-size: 0.82rem; font-weight: 700; font-family: 'DM Sans', sans-serif;
        border-radius: 0.75rem; text-decoration: none;
        background: linear-gradient(135deg, #eff6ff, #eef2ff);
        color: #4f46e5;
        border: 1px solid #e0e7ff;
        transition: all 0.25s ease;
    }
    .therapist-card:hover .view-btn {
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 14px rgba(99,102,241,0.35);
    }
    .view-btn i { font-size: 0.85rem; transition: transform 0.25s ease; }
    .therapist-card:hover .view-btn i { transform: translateX(3px); }

    /* ===== EMPTY STATE ===== */
    .empty-state { text-align: center; padding: 5rem 1.5rem; }
    .empty-icon {
        width: 90px; height: 90px; border-radius: 50%;
        background: linear-gradient(135deg, #eff6ff, #eef2ff);
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; color: #93c5fd;
        margin: 0 auto 1.5rem;
    }

    /* ===== PAGINATION ===== */
    .pagination-wrap {
        margin-top: 2.5rem;
        display: flex; justify-content: center;
    }
    .pagination-wrap .pagination {
        display: flex; align-items: center; gap: 6px; flex-wrap: wrap; justify-content: center;
    }
    .pagination-wrap .page-item .page-link,
    .pagination-wrap nav a,
    .pagination-wrap nav span {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 36px; height: 36px; padding: 0 10px;
        font-size: 0.82rem; font-weight: 600;
        border-radius: 8px; text-decoration: none;
        color: #4f46e5; background: white;
        border: 1.5px solid #e2e8f0;
        transition: all 0.2s ease;
    }
    .pagination-wrap nav a:hover { background: #eff6ff; border-color: #bfdbfe; }
    .pagination-wrap nav span[aria-current] {
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: white; border-color: transparent;
        box-shadow: 0 3px 10px rgba(99,102,241,0.35);
    }

    /* ===== CARD ANIMATION DELAYS ===== */
    .therapist-card:nth-child(1)  { animation-delay: 0.05s; }
    .therapist-card:nth-child(2)  { animation-delay: 0.1s; }
    .therapist-card:nth-child(3)  { animation-delay: 0.15s; }
    .therapist-card:nth-child(4)  { animation-delay: 0.2s; }
    .therapist-card:nth-child(5)  { animation-delay: 0.25s; }
    .therapist-card:nth-child(6)  { animation-delay: 0.3s; }
    .therapist-card:nth-child(7)  { animation-delay: 0.35s; }
    .therapist-card:nth-child(8)  { animation-delay: 0.4s; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 640px) {
        .therapist-grid { grid-template-columns: repeat(2, 1fr); gap: 0.85rem; }
        .card-img-wrap { height: 140px; }
        .card-body { padding: 0.85rem 0.9rem; }
        .card-name { font-size: 0.88rem; }
        .card-desc { font-size: 0.75rem; -webkit-line-clamp: 2; }
        .card-footer { padding: 0 0.9rem 0.9rem; }
        .view-btn { font-size: 0.75rem; padding: 0.55rem; gap: 5px; }
        .img-fee-badge { font-size: 0.65rem; padding: 3px 7px; }
        .page-hero { padding: 2.5rem 1rem 5rem; }
    }
    @media (max-width: 360px) {
        .therapist-grid { grid-template-columns: 1fr; }
    }
    @media (min-width: 1024px) {
        .therapist-grid { grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); }
        .card-img-wrap { height: 210px; }
    }
</style>


<!-- PAGE HERO -->
<section class="page-hero">
    <div class="hero-orb w-64 h-64 bg-blue-600" style="top:-40px; left:-60px; opacity:0.18;"></div>
    <div class="hero-orb w-48 h-48 bg-indigo-600" style="bottom:10px; right:-30px; opacity:0.15; animation-delay:-4s;"></div>

    <div class="relative z-10 max-w-3xl mx-auto">
        <a href="{{ route('home') }}" class="back-link">
            <i class="ri-arrow-left-line"></i>
            Back to Home
        </a>
        <div class="hero-badge mb-3">
            <i class="ri-user-heart-line"></i>
            Specialist Directory
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-3" style="font-family:'Playfair Display',serif; line-height:1.15;">
            {{ $specialists->name }} Therapists
        </h1>
        <p class="text-sm sm:text-base text-blue-200/70 max-w-lg leading-relaxed">
            Certified {{ $specialists->name }} specialists ready to guide your healing journey with compassion and expertise.
        </p>
    </div>
</section>


<!-- THERAPIST LISTING -->
<div class="section-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($therapists->count() > 0)

        <!-- Count Label -->
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-gray-500">
                Showing <span class="font-bold text-gray-900">{{ $therapists->total() }}</span>
                {{ Str::plural('therapist', $therapists->total()) }} in
                <span class="font-bold text-indigo-600">{{ $specialists->name }}</span>
            </p>
        </div>

        <!-- Grid -->
        <div class="therapist-grid">
            @foreach($therapists as $therapist)
            <a href="{{ route('viewtherapist', $therapist->id) }}" class="therapist-card">
                <!-- Image -->
                <div class="card-img-wrap">
                    <img src="{{ asset('images/therapists/' . $therapist->photopath) }}"
                         alt="{{ $therapist->name }}"
                         loading="lazy"
                         onerror="this.style.display='none'; this.parentNode.classList.add('img-fallback');">
                    <div class="img-fee-badge">Rs. {{ $therapist->fee }}</div>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <h3 class="card-name">{{ $therapist->name }}</h3>
                    <p class="card-desc">{{ Str::limit($therapist->description, 90) }}</p>
                </div>

                <!-- Footer CTA -->
                <div class="card-footer">
                    <span class="view-btn">
                        <i class="ri-user-search-line"></i>
                        View Profile
                        <i class="ri-arrow-right-line"></i>
                    </span>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrap">
            {{ $therapists->links() }}
        </div>

        @else

        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="ri-user-heart-line"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-400 mb-2" style="font-family:'Playfair Display',serif;">No Therapists Found</h3>
            <p class="text-sm text-gray-400 max-w-sm mx-auto mb-7 leading-relaxed">
                There are currently no therapists listed under this specialty. Please check back soon.
            </p>
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 px-7 py-3 rounded-full shadow-lg shadow-blue-200 transition-all duration-300 hover:-translate-y-0.5">
                <i class="ri-home-4-line"></i>
                Back to Home
            </a>
        </div>

        @endif
    </div>
</div>

@endsection