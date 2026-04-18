@extends('layouts.master')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">

<style>
    /* ── TOKENS (mirrors nav/footer) ─────────────────────────────── */
    :root {
        --b400: #60a5fa;
        --b500: #3b82f6;
        --b600: #2563eb;
        --b700: #1d4ed8;
        --b900: #1e3a8a;
        --b950: #172554;
        --i600: #4f46e5;
        --i950: #1e1b4b;
        --s900: #0f172a;
        --s800: #1e293b;
        --s700: #334155;
        --g50: #f9fafb;
        --g100: #f3f4f6;
        --g200: #e5e7eb;
        --g600: #4b5563;
        --g700: #374151;
        --wh: #ffffff;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--g50);
    }

    /* ── KEYFRAMES ────────────────────────────────────────────────── */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    @keyframes floatBlob {

        0%,
        100% {
            transform: translateY(0) scale(1);
            opacity: .28
        }

        50% {
            transform: translateY(-18px) scale(1.1);
            opacity: .45
        }
    }

    @keyframes shimmer {
        from {
            transform: translateX(-100%)
        }

        to {
            transform: translateX(100%)
        }
    }

    @keyframes pulse {

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(96, 165, 250, .4)
        }

        50% {
            box-shadow: 0 0 0 10px rgba(96, 165, 250, 0)
        }
    }

    /* ── HERO ─────────────────────────────────────────────────────── */
    .act-hero {
        background: linear-gradient(135deg, var(--b950) 0%, var(--s900) 45%, var(--i950) 100%);
        padding: 5.5rem 1.5rem 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* mesh glow */
    .act-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background:
            radial-gradient(ellipse at 20% 40%, rgba(37, 99, 235, .22) 0%, transparent 55%),
            radial-gradient(ellipse at 80% 60%, rgba(79, 70, 229, .18) 0%, transparent 55%);
    }

    /* top accent line */
    .act-hero::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--b500), var(--i600), var(--b400));
    }

    /* floating blobs */
    .act-hero-blob {
        position: absolute;
        border-radius: 50%;
        background: rgba(96, 165, 250, .2);
        pointer-events: none;
        animation: floatBlob var(--d, 7s) ease-in-out var(--dl, 0s) infinite;
    }

    .act-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 680px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.3rem;
    }

    /* pill */
    .act-pill {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        background: rgba(96, 165, 250, .13);
        border: 1px solid rgba(96, 165, 250, .35);
        color: #93c5fd;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .2em;
        text-transform: uppercase;
        padding: .38rem 1.1rem;
        border-radius: 100px;
        backdrop-filter: blur(10px);
        opacity: 0;
        animation: fadeUp .7s ease .4s forwards;
    }

    .act-pill-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--b400);
        box-shadow: 0 0 8px rgba(96, 165, 250, .9);
        animation: pulse 2s ease-in-out infinite;
    }

    .act-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.9rem, 5vw, 3.4rem);
        font-weight: 700;
        color: var(--wh);
        line-height: 1.12;
        letter-spacing: -.022em;
        opacity: 0;
        animation: fadeUp .8s ease .65s forwards;
    }

    .act-hero h1 em {
        font-style: italic;
        background: linear-gradient(135deg, #93c5fd, #c4b5fd);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .act-hero p {
        color: rgba(255, 255, 255, .68);
        font-size: clamp(.9rem, 2vw, 1.05rem);
        font-weight: 300;
        line-height: 1.82;
        max-width: 540px;
        opacity: 0;
        animation: fadeUp .8s ease .85s forwards;
    }

    /* trust badges */
    .act-trust {
        display: flex;
        align-items: center;
        gap: 1.4rem;
        flex-wrap: wrap;
        justify-content: center;
        opacity: 0;
        animation: fadeUp .7s ease 1.1s forwards;
    }

    .act-trust-item {
        display: flex;
        align-items: center;
        gap: .4rem;
        font-size: .76rem;
        color: rgba(255, 255, 255, .55);
        font-weight: 500;
    }

    .act-trust-item i {
        color: var(--b400);
        font-size: .9rem;
    }

    .act-trust-sep {
        color: rgba(255, 255, 255, .18);
        font-size: .9rem;
    }

    /* ── FILTER BAR ───────────────────────────────────────────────── */
    .filter-bar {
        background: var(--wh);
        border-bottom: 1px solid var(--g200);
        padding: .9rem 1.5rem;
        position: sticky;
        top: 64px;
        z-index: 40;
        box-shadow: 0 1px 8px rgba(15, 23, 42, .05);
    }

    .filter-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        flex-wrap: wrap;
    }

    .filter-count {
        font-size: .82rem;
        color: var(--g600);
        font-weight: 500;
        white-space: nowrap;
    }

    .filter-count strong {
        color: var(--b600);
    }

    .filter-pills {
        display: flex;
        align-items: center;
        gap: .5rem;
        flex-wrap: wrap;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .35rem .85rem;
        border-radius: 100px;
        font-size: .75rem;
        font-weight: 600;
        border: 1px solid var(--g200);
        color: var(--g700);
        background: var(--g50);
        cursor: pointer;
        transition: all .2s;
        white-space: nowrap;
    }

    .filter-pill:hover,
    .filter-pill.active {
        background: var(--b600);
        color: var(--wh);
        border-color: var(--b600);
        box-shadow: 0 2px 10px rgba(37, 99, 235, .25);
    }

    .filter-pill i {
        font-size: .85rem;
    }

    /* ── MAIN CONTENT ─────────────────────────────────────────────── */
    .act-main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem 5rem;
    }

    /* ── VIDEO GRID ───────────────────────────────────────────────── */
    .video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.75rem;
    }

    /* ── VIDEO CARD ───────────────────────────────────────────────── */
    .vcard {
        background: var(--wh);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--g200);
        box-shadow: 0 2px 14px rgba(15, 23, 42, .06);
        display: flex;
        flex-direction: column;
        transition: transform .32s cubic-bezier(.34, 1.46, .64, 1),
            box-shadow .3s, border-color .3s;
    }

    .vcard:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 48px rgba(15, 23, 42, .12);
        border-color: rgba(37, 99, 235, .2);
    }

    /* video wrapper — 16:9 */
    .vcard-media {
        position: relative;
        padding-top: 56.25%;
        background: var(--s900);
        overflow: hidden;
    }

    .vcard-media iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    /* play overlay (decorative) */
    .vcard-media-badge {
        position: absolute;
        top: .75rem;
        left: .75rem;
        z-index: 2;
        background: rgba(37, 99, 235, .85);
        color: var(--wh);
        font-size: .62rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: .2rem .65rem;
        border-radius: 100px;
        backdrop-filter: blur(6px);
    }

    /* card body */
    .vcard-body {
        padding: 1.2rem 1.3rem 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
        gap: .5rem;
    }

    /* category eyebrow */
    .vcard-eye {
        font-size: .65rem;
        font-weight: 700;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: var(--b600);
        display: flex;
        align-items: center;
        gap: .35rem;
    }

    .vcard-eye::before {
        content: '';
        display: block;
        width: 14px;
        height: 1.5px;
        background: linear-gradient(90deg, var(--b500), var(--i600));
        border-radius: 2px;
    }

    .vcard-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--s900);
        line-height: 1.28;
    }

    .vcard-desc {
        font-size: .83rem;
        color: var(--g600);
        line-height: 1.7;
        flex: 1;
    }

    /* footer row */
    .vcard-footer {
        margin-top: .65rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .5rem;
    }

    .watch-btn {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        background: linear-gradient(135deg, var(--b600), var(--i600));
        color: var(--wh);
        font-size: .8rem;
        font-weight: 600;
        padding: .6rem 1.15rem;
        border-radius: 100px;
        text-decoration: none;
        box-shadow: 0 4px 14px rgba(37, 99, 235, .3);
        position: relative;
        overflow: hidden;
        transition: transform .2s, box-shadow .2s, gap .2s;
    }

    .watch-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .15), transparent);
        transform: translateX(-100%);
        transition: transform .5s ease;
    }

    .watch-btn:hover::before {
        transform: translateX(100%);
    }

    .watch-btn:hover {
        transform: translateY(-1px);
        gap: .6rem;
        box-shadow: 0 8px 22px rgba(37, 99, 235, .4);
    }

    .watch-btn svg {
        transition: transform .2s;
        flex-shrink: 0;
    }

    .watch-btn:hover svg {
        transform: translateX(2px);
    }

    .vcard-dur {
        display: flex;
        align-items: center;
        gap: .3rem;
        font-size: .72rem;
        color: var(--g600);
        font-weight: 500;
    }

    .vcard-dur i {
        font-size: .8rem;
        color: var(--b500);
    }

    /* ── EMPTY STATE ──────────────────────────────────────────────── */
    .empty-state {
        grid-column: 1/-1;
        text-align: center;
        padding: 5rem 1.5rem;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--b50, #eff6ff);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        font-size: 2rem;
        color: var(--b500);
    }

    .empty-state h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        color: var(--s900);
        margin-bottom: .5rem;
    }

    .empty-state p {
        font-size: .9rem;
        color: var(--g600);
    }

    /* ── CTA STRIP ────────────────────────────────────────────────── */
    .cta-strip {
        background: linear-gradient(135deg, var(--b950) 0%, var(--s900) 50%, var(--i950) 100%);
        padding: 4.5rem 1.5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-strip::before {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background:
            radial-gradient(circle at 25% 50%, rgba(37, 99, 235, .18) 0%, transparent 50%),
            radial-gradient(circle at 76% 30%, rgba(79, 70, 229, .15) 0%, transparent 50%);
    }

    .cta-strip-inner {
        position: relative;
        max-width: 620px;
        margin: 0 auto;
    }

    .cta-strip h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.7rem, 4vw, 2.6rem);
        font-weight: 700;
        color: var(--wh);
        line-height: 1.2;
        margin-bottom: .85rem;
    }

    .cta-strip h2 span {
        background: linear-gradient(135deg, #93c5fd, #c4b5fd);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-style: italic;
    }

    .cta-strip p {
        color: rgba(255, 255, 255, .62);
        font-size: .97rem;
        line-height: 1.78;
        margin-bottom: 2rem;
    }

    .cta-strip-btns {
        display: flex;
        gap: .85rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-cta-main {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        background: linear-gradient(135deg, var(--b600), var(--i600));
        color: var(--wh);
        font-weight: 700;
        font-size: .9rem;
        padding: .88rem 2rem;
        border-radius: 100px;
        text-decoration: none;
        box-shadow: 0 8px 28px rgba(37, 99, 235, .4);
        position: relative;
        overflow: hidden;
        transition: transform .25s, box-shadow .25s;
    }

    .btn-cta-main::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .15), transparent);
        transform: translateX(-100%);
        transition: transform .55s ease;
    }

    .btn-cta-main:hover::before {
        transform: translateX(100%);
    }

    .btn-cta-main:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 36px rgba(37, 99, 235, .52);
    }

    .btn-cta-ol {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        background: transparent;
        color: var(--wh);
        font-weight: 600;
        font-size: .9rem;
        padding: .88rem 2rem;
        border-radius: 100px;
        border: 1px solid rgba(255, 255, 255, .28);
        text-decoration: none;
        backdrop-filter: blur(8px);
        transition: background .25s, transform .22s;
    }

    .btn-cta-ol:hover {
        background: rgba(255, 255, 255, .1);
        transform: translateY(-2px);
    }

    /* ── RESPONSIVE ───────────────────────────────────────────────── */
    @media (max-width:768px) {
        .act-hero {
            padding: 4rem 1.25rem 3rem;
        }

        .act-trust {
            gap: 1rem;
        }

        .act-trust-sep {
            display: none;
        }

        .video-grid {
            grid-template-columns: 1fr;
            gap: 1.1rem;
        }

        .filter-bar {
            top: 56px;
            padding: .7rem 1rem;
        }

        .filter-pills {
            gap: .4rem;
        }

        .filter-pill {
            padding: .3rem .7rem;
            font-size: .7rem;
        }

        .filter-pill span {
            display: none;
        }

        /* icon-only on small screens */
        .act-main {
            padding: 1.75rem 1rem 4rem;
        }

        .vcard-body {
            padding: 1rem 1.1rem 1.25rem;
        }

        .watch-btn {
            font-size: .75rem;
            padding: .52rem .95rem;
        }

        .cta-strip {
            padding: 3.5rem 1.25rem;
        }
    }

    @media (max-width:480px) {
        .act-hero h1 {
            font-size: 1.75rem;
        }

        .vcard-title {
            font-size: .97rem;
        }

        .vcard-footer {
            flex-direction: column;
            align-items: flex-start;
        }

        .watch-btn {
            width: 100%;
            justify-content: center;
        }

        .cta-strip-btns {
            flex-direction: column;
            align-items: center;
        }

        .btn-cta-main,
        .btn-cta-ol {
            width: 100%;
            justify-content: center;
        }
    }
</style>

{{-- ══════ HERO ══════ --}}
<div class="act-hero">
    {{-- blobs --}}
    <div class="act-hero-blob" style="width:180px;height:180px;top:5%;left:2%;--d:7s;--dl:0s"></div>
    <div class="act-hero-blob" style="width:90px;height:90px;top:65%;left:10%;--d:9s;--dl:1.2s"></div>
    <div class="act-hero-blob" style="width:130px;height:130px;top:10%;right:5%;--d:8s;--dl:.6s"></div>
    <div class="act-hero-blob" style="width:60px;height:60px;top:70%;right:12%;--d:6.5s;--dl:1.8s"></div>

    <div class="act-hero-inner">
        <span class="act-pill">
            <span class="act-pill-dot"></span>
            Mindfulness &amp; Wellness
        </span>

        <h1>Curated <em>Wellness</em><br>Video Library</h1>

        <p>
            Feeling mentally or physically drained? These videos are specially curated by our therapists to help you restore balance, reduce stress, and find your inner calm.
        </p>

        <div class="act-trust">
            <span class="act-trust-item"><i class="ri-video-line"></i> Expert Curated</span>
            <span class="act-trust-sep">|</span>
            <span class="act-trust-item"><i class="ri-shield-check-line"></i> Safe Content</span>
            <span class="act-trust-sep">|</span>
            <span class="act-trust-item"><i class="ri-time-line"></i> Watch Anytime</span>
        </div>
    </div>
</div>

{{-- ══════ FILTER BAR ══════ --}}
<div class="filter-bar">
    <div class="filter-inner">
        <span class="filter-count">
            Showing <strong>{{ $activities->count() }}</strong> wellness videos
        </span>

        <div class="filter-pills">
            <!-- ALL -->
            <span class="filter-pill active" data-filter="all">
                <i class="ri-apps-line"></i>
                <span>All Videos</span>
            </span>

            <!-- CATEGORIES -->
            @foreach($categories as $category)
            <span class="filter-pill"
                data-filter="{{ Str::slug($category->name ?? '') }}">
                <i class="ri-folder-2-line"></i>
                <span>{{ $category->name }}</span>
            </span>
            @endforeach
        </div>
    </div>
</div>

{{-- ══════ MAIN GRID ══════ --}}
<div class="act-main">
    <div class="video-grid">
        @forelse($activities as $activity)
        <div class="vcard"
            data-category="{{ Str::slug($activity->category->name ?? '') }}">

            {{-- video embed --}}
            <div class="vcard-media">
                <span class="vcard-media-badge">
                    <i class="ri-live-line" style="margin-right:.3rem;font-size:.75rem;"></i>Video
                </span>
                <iframe
                    src="{{ $activity->video_url }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    loading="lazy">
                </iframe>
            </div>

            {{-- card body --}}
            <div class="vcard-body">
                <!-- show actual category name -->
                <span class="vcard-eye">
                    {{ $activity->category->name ?? 'General' }}
                </span>

                <h3 class="vcard-title">{{ $activity->title }}</h3>
                <p class="vcard-desc">{{ Str::limit($activity->description, 100) }}</p>

                <div class="vcard-footer">
                    <a href="{{ $activity->video_url }}" target="_blank" rel="noopener" class="watch-btn">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                        Watch Full Video
                    </a>

                    <span class="vcard-dur">
                        <i class="ri-time-line"></i>
                        Free
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-state-icon"><i class="ri-video-off-line"></i></div>
            <h3>No Videos Available Yet</h3>
            <p>Check back soon — our therapists are curating new wellness content for you.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- ══════ CTA STRIP ══════ --}}
<div class="cta-strip">
    <div class="cta-strip-inner">
        <h2>Ready to Talk to a <span>Real Therapist?</span></h2>
        <p>Videos are a great start — but nothing replaces the power of a one-on-one session with a certified professional.</p>
        <div class="cta-strip-btns">
            <a href="{{ route('home') }}#therapists" class="btn-cta-main">
                <i class="ri-user-heart-line"></i>
                Meet Our Therapists
            </a>
            <a href="{{ route('home') }}" class="btn-cta-ol">
                <i class="ri-home-4-line"></i>
                Back to Home
            </a>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const filterPills = document.querySelectorAll('.filter-pill');
    const cards = document.querySelectorAll('.vcard');

    filterPills.forEach(pill => {
        pill.addEventListener('click', function () {

            // Active button UI
            filterPills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            cards.forEach(card => {
                const category = card.getAttribute('data-category');

                if (filter === 'all' || filter === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

});
</script>
@endsection