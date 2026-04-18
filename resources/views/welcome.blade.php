@extends('layouts.master')

@section('content')

{{-- Fonts: Playfair Display already in master layout; load here as fallback --}}
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">

<style>
  /* ── DESIGN TOKENS (mirrors master layout) ───────────────────── */
  :root {
    --b50:  #eff6ff;  --b100: #dbeafe;
    --b400: #60a5fa;  --b500: #3b82f6;
    --b600: #2563eb;  --b700: #1d4ed8;
    --b900: #1e3a8a;  --b950: #172554;
    --i500: #6366f1;  --i600: #4f46e5; --i950: #1e1b4b;
    --s900: #0f172a;  --s800: #1e293b;
    --s700: #334155;  --s400: #94a3b8;
    --g50:  #f9fafb;  --g100: #f3f4f6;
    --g200: #e5e7eb;  --g600: #4b5563;
    --g700: #374151;  --wh:   #ffffff;
    --gold: #f59e0b;
  }
  *, *::before, *::after { box-sizing: border-box; }

  /* ── KEYFRAMES ───────────────────────────────────────────────── */
  @keyframes heroZoom   { from{transform:scale(1.06)} to{transform:scale(1)} }
  @keyframes fadeUp     { from{opacity:0;transform:translateY(22px)} to{opacity:1;transform:translateY(0)} }
  @keyframes scrollBob  { 0%,100%{top:5px;opacity:1} 50%{top:22px;opacity:.3} }
  @keyframes floatBlob  { 0%,100%{transform:translateY(0) scale(1);opacity:.3} 50%{transform:translateY(-20px) scale(1.12);opacity:.5} }
  @keyframes shimmer    { from{transform:translateX(-100%)} to{transform:translateX(100%)} }

  /* ── HERO ────────────────────────────────────────────────────── */
  .hero {
    position: relative;
    width: 100%;
    min-height: 100svh;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .hero__img {
    position: absolute;
    inset: 0; width: 100%; height: 100%;
    object-fit: cover;
    object-position: center 25%;
    animation: heroZoom 14s ease-out forwards;
  }
  .hero__overlay {
    position: absolute; inset: 0; z-index: 1;
    background: linear-gradient(135deg,
      rgba(23,37,84,.85) 0%,
      rgba(30,58,138,.68) 45%,
      rgba(15,23,42,.78) 100%);
  }
  .hero__mesh {
    position: absolute; inset: 0; z-index: 2; pointer-events: none;
    background:
      radial-gradient(circle at 18% 28%, rgba(96,165,250,.2) 0%, transparent 50%),
      radial-gradient(circle at 82% 72%, rgba(79,70,229,.16) 0%, transparent 50%);
  }
  /* floating blobs */
  .hero__blob {
    position: absolute; border-radius: 50%;
    background: rgba(96,165,250,.18);
    z-index: 2; pointer-events: none;
    animation: floatBlob var(--d,7s) ease-in-out var(--dl,0s) infinite;
  }

  .hero__content {
    position: relative; z-index: 3;
    display: flex; flex-direction: column;
    align-items: center; text-align: center;
    padding: 8rem 1.5rem 5rem;
    gap: 1.6rem; max-width: 960px; margin: 0 auto;
  }

  /* eyebrow pill */
  .hero__pill {
    display: inline-flex; align-items: center; gap: .65rem;
    background: rgba(96,165,250,.14);
    border: 1px solid rgba(96,165,250,.38);
    color: #93c5fd;
    font-size: .72rem; font-weight: 600;
    letter-spacing: .2em; text-transform: uppercase;
    padding: .42rem 1.2rem; border-radius: 100px;
    backdrop-filter: blur(10px);
    opacity: 0; animation: fadeUp .7s ease .55s forwards;
  }
  .hero__pill-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--b400);
    box-shadow: 0 0 8px rgba(96,165,250,.9);
  }

  /* headline */
  .hero__h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.8rem, 7.5vw, 5.8rem);
    font-weight: 700; color: var(--wh);
    line-height: 1.08; letter-spacing: -.025em;
    opacity: 0; animation: fadeUp .85s ease .85s forwards;
  }
  .hero__h1 em {
    font-style: italic;
    background: linear-gradient(135deg, #93c5fd 10%, #c4b5fd 90%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .hero__sub {
    font-size: clamp(.95rem, 2vw, 1.2rem);
    font-weight: 300; color: rgba(255,255,255,.74);
    max-width: 560px; line-height: 1.82;
    opacity: 0; animation: fadeUp .85s ease 1.1s forwards;
  }

  .hero__btns {
    display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;
    opacity: 0; animation: fadeUp .85s ease 1.3s forwards;
  }

  .btn-prim {
    display: inline-flex; align-items: center; gap: .55rem;
    background: linear-gradient(135deg, var(--b600), var(--i600));
    color: var(--wh); font-weight: 600; font-size: .95rem;
    padding: .88rem 2.1rem; border-radius: 100px;
    text-decoration: none;
    box-shadow: 0 8px 28px rgba(37,99,235,.45);
    position: relative; overflow: hidden;
    transition: transform .22s, box-shadow .25s;
  }
  .btn-prim::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.16), transparent);
    transform: translateX(-100%); transition: transform .6s ease;
  }
  .btn-prim:hover::before { transform: translateX(100%); }
  .btn-prim:hover { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(37,99,235,.55); }

  .btn-ghost {
    display: inline-flex; align-items: center; gap: .55rem;
    background: rgba(255,255,255,.09); color: var(--wh);
    font-weight: 500; font-size: .95rem;
    padding: .88rem 2.1rem; border-radius: 100px;
    border: 1px solid rgba(255,255,255,.28); text-decoration: none;
    backdrop-filter: blur(10px);
    transition: background .25s, transform .22s;
  }
  .btn-ghost:hover { background: rgba(255,255,255,.17); transform: translateY(-2px); }

  /* trust bar */
  .hero__trust {
    display: flex; align-items: center; gap: 1.5rem;
    flex-wrap: wrap; justify-content: center;
    opacity: 0; animation: fadeUp .7s ease 1.55s forwards;
  }
  .hero__trust-item {
    display: flex; align-items: center; gap: .45rem;
    font-size: .79rem; color: rgba(255,255,255,.58); font-weight: 500;
  }
  .hero__trust-item i { color: var(--b400); font-size: .95rem; }
  .hero__trust-sep { color: rgba(255,255,255,.2); }

  /* scroll cue */
  .hero__scroll {
    position: absolute; bottom: 2.2rem; left: 50%;
    transform: translateX(-50%);
    z-index: 4; display: flex; flex-direction: column;
    align-items: center; gap: .5rem;
    color: rgba(255,255,255,.42); font-size: .64rem;
    letter-spacing: .18em; text-transform: uppercase;
    opacity: 0; animation: fadeUp .7s ease 2s forwards;
  }
  .hero__mouse {
    width: 22px; height: 36px;
    border: 1.5px solid rgba(255,255,255,.28);
    border-radius: 100px; position: relative;
  }
  .hero__mouse::after {
    content: ''; position: absolute;
    top: 5px; left: 50%; transform: translateX(-50%);
    width: 3px; height: 3px; border-radius: 50%;
    background: rgba(255,255,255,.7);
    animation: scrollBob 1.9s ease-in-out infinite;
  }

  /* ── STATS ───────────────────────────────────────────────────── */
  .stats-bar {
    background: var(--s900);
    display: flex; justify-content: center; flex-wrap: wrap;
    border-top: 1px solid rgba(96,165,250,.09);
  }
  .stat {
    flex: 1; min-width: 155px; max-width: 260px;
    padding: 1.85rem 1.4rem; text-align: center;
    border-right: 1px solid rgba(255,255,255,.06);
    transition: background .25s;
  }
  .stat:last-child { border-right: none; }
  .stat:hover { background: rgba(96,165,250,.05); }
  .stat__n {
    font-family: 'Playfair Display', serif;
    font-size: 2.35rem; font-weight: 700; line-height: 1;
    background: linear-gradient(135deg, #60a5fa, #a78bfa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .stat__l {
    font-size: .7rem; font-weight: 600;
    color: rgba(255,255,255,.38);
    letter-spacing: .13em; text-transform: uppercase;
    margin-top: .35rem;
  }

  /* ── SECTION HELPERS ─────────────────────────────────────────── */
  .sec { padding: 5.5rem 1.5rem; }

  .eyebrow {
    display: inline-flex; align-items: center; gap: .6rem;
    font-size: .69rem; font-weight: 700;
    letter-spacing: .22em; text-transform: uppercase;
    color: var(--b600); margin-bottom: .85rem;
  }
  .eyebrow::before {
    content: ''; display: block;
    width: 22px; height: 2px;
    background: linear-gradient(90deg, var(--b500), var(--i600));
    border-radius: 2px;
  }
  .sec-h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.85rem, 4vw, 2.9rem);
    font-weight: 700; color: var(--s900);
    line-height: 1.18; letter-spacing: -.02em;
  }
  .sec-desc {
    color: var(--g600); font-size: .98rem;
    line-height: 1.8; max-width: 490px; margin-top: .7rem;
  }

  /* ── THERAPIST CARDS ─────────────────────────────────────────── */
  .therapists-sec { background: var(--g50); }
  .therapists-hd {
    display: flex; flex-direction: column;
    align-items: center; text-align: center;
    margin-bottom: 3.5rem;
  }
  .therapists-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(238px,1fr));
    gap: 1.65rem; max-width: 1280px; margin: 0 auto;
  }

  .tcard {
    background: var(--wh); border-radius: 18px;
    overflow: hidden; text-decoration: none;
    border: 1px solid var(--g200);
    box-shadow: 0 1px 10px rgba(15,23,42,.06);
    display: flex; flex-direction: column;
    transition: transform .32s cubic-bezier(.34,1.46,.64,1), box-shadow .3s, border-color .3s;
  }
  .tcard:hover { transform: translateY(-7px); box-shadow: 0 20px 50px rgba(15,23,42,.12); border-color: rgba(37,99,235,.2); }

  .tcard-top {
    background: linear-gradient(135deg, #dbeafe 0%, #ede9fe 100%);
    padding: 2rem 1.4rem 1.4rem;
    display: flex; flex-direction: column;
    align-items: center; gap: .85rem;
    position: relative; overflow: hidden;
  }
  .tcard-top::after {
    content: ''; position: absolute;
    bottom: -24px; right: -24px;
    width: 80px; height: 80px; border-radius: 50%;
    background: rgba(37,99,235,.1);
  }
  .tcard-avatar {
    width: 84px; height: 84px; border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--wh);
    box-shadow: 0 6px 20px rgba(15,23,42,.14);
    transition: transform .3s; position: relative; z-index:1;
  }
  .tcard:hover .tcard-avatar { transform: scale(1.07); }
  .tcard-badge {
    background: var(--wh); color: var(--b700);
    font-size: .67rem; font-weight: 700;
    letter-spacing: .1em; text-transform: uppercase;
    padding: .27rem .88rem; border-radius: 100px;
    box-shadow: 0 2px 8px rgba(15,23,42,.08);
    position: relative; z-index:1;
  }
  .tcard-body {
    padding: 1.25rem 1.35rem 1.6rem;
    display: flex; flex-direction: column; flex: 1; gap: .52rem;
  }
  .tcard-name {
    font-family: 'Playfair Display', serif;
    font-size: 1.17rem; font-weight: 700;
    color: var(--s900); line-height: 1.25;
  }
  .tcard-desc {
    font-size: .85rem; color: var(--g600);
    line-height: 1.68; flex: 1;
  }
  .tcard-cta {
    margin-top: .45rem;
    display: inline-flex; align-items: center;
    justify-content: center; gap: .45rem;
    background: linear-gradient(135deg, var(--b600), var(--i600));
    color: var(--wh); font-size: .82rem; font-weight: 600;
    padding: .62rem 1.3rem; border-radius: 100px;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(37,99,235,.3);
    transition: opacity .2s, gap .2s, transform .2s;
  }
  .tcard-cta:hover { opacity: .9; gap: .65rem; transform: translateY(-1px); }
  .tcard-cta svg { transition: transform .2s; }
  .tcard:hover .tcard-cta svg { transform: translateX(3px); }

  /* ── FEATURE SPLIT ───────────────────────────────────────────── */
  .feature-sec {
    background: var(--wh);
    position: relative; overflow: hidden;
  }
  .feature-sec::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, var(--b500), var(--i600), var(--b400));
  }
  .feature-inner {
    max-width: 1100px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 4rem; align-items: center;
  }
  .feature-img-wrap {
    border-radius: 22px; overflow: hidden;
    box-shadow: 0 24px 64px rgba(15,23,42,.13);
    position: relative;
  }
  .feature-img-wrap img {
    width: 100%; display: block;
    object-fit: cover; height: 450px;
  }
  .feature-badge {
    position: absolute; bottom: 1.4rem; left: 1.4rem;
    background: rgba(255,255,255,.93); backdrop-filter: blur(14px);
    border-radius: 15px; padding: .85rem 1.1rem;
    display: flex; align-items: center; gap: .7rem;
    box-shadow: 0 8px 28px rgba(15,23,42,.14);
  }
  .feature-badge-icon {
    width: 38px; height: 38px; border-radius: 10px;
    background: linear-gradient(135deg, var(--b600), var(--i600));
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.05rem;
  }
  .feature-badge-text strong { display: block; font-size: .83rem; font-weight: 700; color: var(--s900); }
  .feature-badge-text span  { font-size: .71rem; color: var(--g600); }

  .feature-list { display: flex; flex-direction: column; gap: 1.45rem; margin-top: 1.8rem; }
  .fitem { display: flex; gap: .95rem; align-items: flex-start; }
  .fitem-icon {
    width: 44px; height: 44px; border-radius: 12px;
    background: var(--b50); flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    color: var(--b600); font-size: 1.15rem;
    transition: background .25s, transform .25s;
  }
  .fitem:hover .fitem-icon { background: var(--b100); transform: scale(1.08); }
  .fitem strong { display: block; font-size: .93rem; font-weight: 600; color: var(--s900); margin-bottom: .22rem; }
  .fitem p { font-size: .84rem; color: var(--g600); line-height: 1.72; margin: 0; }

  /* ── WHY US ──────────────────────────────────────────────────── */
  .why-sec {
    background: var(--s900);
    position: relative; overflow: hidden;
  }
  .why-sec::before {
    content: ''; position: absolute;
    top: -100px; right: -100px;
    width: 480px; height: 480px; border-radius: 50%;
    background: radial-gradient(circle, rgba(37,99,235,.14) 0%, transparent 70%);
    pointer-events: none;
  }
  .why-sec::after {
    content: ''; position: absolute;
    bottom: -80px; left: -80px;
    width: 380px; height: 380px; border-radius: 50%;
    background: radial-gradient(circle, rgba(79,70,229,.1) 0%, transparent 70%);
    pointer-events: none;
  }
  .why-hd { text-align: center; margin-bottom: 3.5rem; }
  .why-hd .eyebrow { color: var(--b400); }
  .why-hd .eyebrow::before { background: linear-gradient(90deg, var(--b400), #a78bfa); }
  .why-hd .sec-h2 { color: var(--wh); }

  .why-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(238px,1fr));
    gap: 1.35rem; max-width: 1200px; margin: 0 auto;
    position: relative; z-index: 1;
  }
  .why-card {
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(255,255,255,.07);
    border-radius: 18px; padding: 1.9rem 1.65rem;
    position: relative; overflow: hidden;
    transition: background .3s, border-color .3s, transform .3s;
  }
  .why-card:hover { background: rgba(255,255,255,.07); border-color: rgba(96,165,250,.25); transform: translateY(-4px); }
  .why-num {
    font-family: 'Playfair Display', serif;
    font-size: 3.6rem; font-weight: 700;
    color: rgba(96,165,250,.09); line-height: 1;
    position: absolute; top: .8rem; right: 1.1rem;
    transition: color .3s;
  }
  .why-card:hover .why-num { color: rgba(96,165,250,.18); }
  .why-icon {
    width: 46px; height: 46px; border-radius: 12px;
    background: rgba(37,99,235,.22);
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 1.2rem;
    transition: background .3s;
  }
  .why-card:hover .why-icon { background: rgba(37,99,235,.38); }
  .why-icon i { font-size: 1.28rem; color: var(--b400); }
  .why-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem; font-weight: 700;
    color: var(--wh); margin-bottom: .55rem; line-height: 1.25;
  }
  .why-desc { font-size: .85rem; color: rgba(255,255,255,.46); line-height: 1.76; }

  /* ── TESTIMONIAL ─────────────────────────────────────────────── */
  .testi-strip {
    background: var(--b50);
    border-top: 1px solid var(--b100);
    border-bottom: 1px solid var(--b100);
    padding: 4.2rem 1.5rem; text-align: center;
  }
  .testi-strip blockquote {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.1rem, 2.4vw, 1.45rem);
    font-style: italic; color: var(--s700);
    max-width: 640px; margin: 0 auto 1.1rem;
    line-height: 1.72;
  }
  .testi-strip cite {
    font-style: normal; font-size: .8rem; font-weight: 600;
    color: var(--b600); letter-spacing: .09em; text-transform: uppercase;
  }

  /* ── CTA SECTION ─────────────────────────────────────────────── */
  .cta-sec {
    background: linear-gradient(135deg, var(--b950) 0%, var(--s900) 50%, var(--i950) 100%);
    padding: 6rem 1.5rem; text-align: center;
    position: relative; overflow: hidden;
  }
  .cta-sec::before {
    content: ''; position: absolute; inset: 0;
    background:
      radial-gradient(circle at 25% 50%, rgba(37,99,235,.18) 0%, transparent 50%),
      radial-gradient(circle at 76% 28%, rgba(79,70,229,.15) 0%, transparent 48%);
    pointer-events: none;
  }
  .cta-inner { position: relative; max-width: 660px; margin: 0 auto; }
  .cta-h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 4.5vw, 3.1rem);
    font-weight: 700; color: var(--wh);
    line-height: 1.18; margin-bottom: .95rem;
  }
  .cta-h2 span {
    background: linear-gradient(135deg, #93c5fd, #c4b5fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; background-clip: text;
    font-style: italic;
  }
  .cta-sub {
    color: rgba(255,255,255,.63); font-size: 1.02rem;
    line-height: 1.8; margin-bottom: 2.4rem;
  }
  .cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
  .btn-cta {
    display: inline-flex; align-items: center; gap: .55rem;
    background: linear-gradient(135deg, var(--b600), var(--i600));
    color: var(--wh); font-weight: 700; font-size: .93rem;
    padding: .92rem 2.2rem; border-radius: 100px;
    text-decoration: none;
    box-shadow: 0 8px 30px rgba(37,99,235,.42);
    position: relative; overflow: hidden;
    transition: transform .25s, box-shadow .25s;
  }
  .btn-cta::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.15), transparent);
    transform: translateX(-100%); transition: transform .55s ease;
  }
  .btn-cta:hover::before { transform: translateX(100%); }
  .btn-cta:hover { transform: translateY(-3px); box-shadow: 0 14px 40px rgba(37,99,235,.55); }
  .btn-cta-ol {
    display: inline-flex; align-items: center; gap: .55rem;
    background: transparent; color: var(--wh);
    font-weight: 600; font-size: .93rem;
    padding: .92rem 2.2rem; border-radius: 100px;
    border: 1px solid rgba(255,255,255,.28); text-decoration: none;
    backdrop-filter: blur(8px);
    transition: background .25s, transform .22s;
  }
  .btn-cta-ol:hover { background: rgba(255,255,255,.1); transform: translateY(-2px); }

  /* ── RESPONSIVE ──────────────────────────────────────────────── */
  @media (max-width: 900px) {
    .feature-inner { grid-template-columns: 1fr; }
    .feature-img-wrap img { height: 300px; }
  }
  @media (max-width: 768px) {
    .sec { padding: 4rem 1.25rem; }
    .stat { min-width: 50%; max-width: 50%; border-right: none; border-bottom: 1px solid rgba(255,255,255,.06); }
    .stat:nth-child(odd) { border-right: 1px solid rgba(255,255,255,.06); }
    .stat:nth-last-child(-n+2) { border-bottom: none; }
  }
  @media (max-width: 520px) {
    .hero__btns { flex-direction: column; align-items: stretch; }
    .btn-prim, .btn-ghost { justify-content: center; }
    .therapists-grid, .why-grid { grid-template-columns: 1fr; }
    .stat { min-width: 100%; max-width: 100%; border-right: none; }
    .cta-btns { flex-direction: column; align-items: center; }
  }
</style>

{{-- ══════ HERO ══════ --}}
@if(Route::currentRouteName() == 'home')
<div class="hero">

  {{-- Blobs --}}
  <div class="hero__blob" style="width:200px;height:200px;top:8%;left:4%;--d:7.5s;--dl:0s"></div>
  <div class="hero__blob" style="width:100px;height:100px;top:62%;left:13%;--d:9s;--dl:1.2s"></div>
  <div class="hero__blob" style="width:150px;height:150px;top:18%;right:6%;--d:8s;--dl:.6s"></div>
  <div class="hero__blob" style="width:65px;height:65px;top:72%;right:16%;--d:6.5s;--dl:1.8s"></div>

  {{--
    Unsplash professional therapy/wellness image (free to use, no attribution required).
    Replace src with {{ asset('imagess/therapist.jpg') }} to use your own photo.
  --}}
  <img
    src="https://images.unsplash.com/photo-1573497019418-b400bb3ab074?w=1920&q=85&auto=format&fit=crop"
    alt="Professional therapy session"
    class="hero__img">

  <div class="hero__overlay"></div>
  <div class="hero__mesh"></div>

  <div class="hero__content">

    <span class="hero__pill">
      <span class="hero__pill-dot"></span>
      Mental Wellness Platform
    </span>

    <h1 class="hero__h1">
      Find Your Path<br>to <em>Lasting Wellness</em>
    </h1>

    <p class="hero__sub">
      Connect with certified therapists, explore evidence-based mindfulness tools, and begin your mental health journey — in one safe, compassionate space.
    </p>

    <div class="hero__btns">
      <a href="#therapists" class="btn-prim">
        <i class="ri-user-heart-line"></i>
        Meet Our Therapists
      </a>
      <a href="#why-us" class="btn-ghost">
        <i class="ri-play-circle-line"></i>
        Why Choose Us?
      </a>
    </div>

    <div class="hero__trust">
      <span class="hero__trust-item"><i class="ri-shield-check-line"></i> 100% Confidential</span>
      <span class="hero__trust-sep">|</span>
      <span class="hero__trust-item"><i class="ri-medal-line"></i> Licensed Professionals</span>
      <span class="hero__trust-sep">|</span>
      <span class="hero__trust-item"><i class="ri-calendar-check-line"></i> Easy Scheduling</span>
    </div>

  </div>

  <div class="hero__scroll">
    <div class="hero__mouse"></div>
    Scroll
  </div>

</div>
@endif

{{-- ══════ STATS ══════ --}}
<div class="stats-bar">
  <div class="stat"><div class="stat__n">500+</div><div class="stat__l">Certified Therapists</div></div>
  <div class="stat"><div class="stat__n">12K+</div><div class="stat__l">Clients Supported</div></div>
  <div class="stat"><div class="stat__n">98%</div><div class="stat__l">Satisfaction Rate</div></div>
  <div class="stat"><div class="stat__n">24/7</div><div class="stat__l">Always Available</div></div>
</div>

{{-- ══════ THERAPISTS ══════ --}}
<section class="sec therapists-sec" id="therapists">
  <div class="therapists-hd">
    <span class="eyebrow">Our Specialists</span>
    <h2 class="sec-h2">Meet Our Expert Therapists</h2>
    <p class="sec-desc" style="margin:0 auto;">
      Every professional is rigorously vetted, fully licensed, and dedicated to your wellbeing.
    </p>
  </div>
  <div class="therapists-grid">
    @foreach($therapists as $therapist)
    <a href="{{ route('viewtherapist', $therapist->id) }}" class="tcard">
      <div class="tcard-top">
        <img src="{{ asset('images/therapists/' . $therapist->photopath) }}"
             alt="{{ $therapist->name }}" class="tcard-avatar">
        <span class="tcard-badge">{{ $therapist->specialization }}</span>
      </div>
      <div class="tcard-body">
        <h3 class="tcard-name">{{ $therapist->name }}</h3>
        <p class="tcard-desc">{{ Str::limit($therapist->description, 90, '…') }}</p>
        <span class="tcard-cta">
          View Profile
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </span>
      </div>
    </a>
    @endforeach
  </div>
</section>

{{-- ══════ FEATURE SPLIT ══════ --}}
<section class="sec feature-sec">
  <div class="feature-inner">
    <div class="feature-img-wrap">
      <img src="https://images.unsplash.com/photo-1607962837359-5e7e89f86776?w=900&q=80&auto=format&fit=crop"
           alt="Mindfulness session">
      <div class="feature-badge">
        <div class="feature-badge-icon"><i class="ri-heart-pulse-line"></i></div>
        <div class="feature-badge-text">
          <strong>Evidence-Based Therapy</strong>
          <span>CBT, DBT, Mindfulness & more</span>
        </div>
      </div>
    </div>
    <div>
      <span class="eyebrow">Why It Works</span>
      <h2 class="sec-h2">A Thoughtful Approach<br>to Mental Health</h2>
      <p class="sec-desc">We combine expert human connection with research-backed tools so your healing journey feels both personal and deeply effective.</p>
      <div class="feature-list">
        <div class="fitem">
          <div class="fitem-icon"><i class="ri-user-heart-line"></i></div>
          <div>
            <strong>Personalized Matching</strong>
            <p>We pair you with the right therapist based on your needs, goals, and preferences.</p>
          </div>
        </div>
        <div class="fitem">
          <div class="fitem-icon"><i class="ri-lock-2-line"></i></div>
          <div>
            <strong>Private & Secure</strong>
            <p>All sessions and data are fully encrypted and strictly confidential.</p>
          </div>
        </div>
        <div class="fitem">
          <div class="fitem-icon"><i class="ri-line-chart-line"></i></div>
          <div>
            <strong>Progress Tracking</strong>
            <p>Monitor your mental wellness journey with our built-in progress tracker.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══════ WHY US ══════ --}}
<section class="sec why-sec" id="why-us">
  <div class="why-hd">
    <span class="eyebrow">Our Advantages</span>
    <h2 class="sec-h2">Why Choose Relief?</h2>
  </div>
  <div class="why-grid">
    <div class="why-card">
      <span class="why-num">01</span>
      <div class="why-icon"><i class="ri-award-line"></i></div>
      <h3 class="why-title">Expert Therapists</h3>
      <p class="why-desc">Connect with thoroughly vetted, licensed professionals who guide you through every step of your mental health journey.</p>
    </div>
    <div class="why-card">
      <span class="why-num">02</span>
      <div class="why-icon"><i class="ri-video-line"></i></div>
      <h3 class="why-title">Mindfulness Resources</h3>
      <p class="why-desc">Access a curated library of mindfulness videos and exercises crafted to build emotional resilience and inner calm.</p>
    </div>
    <div class="why-card">
      <span class="why-num">03</span>
      <div class="why-icon"><i class="ri-customer-service-2-line"></i></div>
      <h3 class="why-title">24/7 Support</h3>
      <p class="why-desc">Whenever you need guidance, our support team and resources are available around the clock, every day of the year.</p>
    </div>
    <div class="why-card">
      <span class="why-num">04</span>
      <div class="why-icon"><i class="ri-layout-line"></i></div>
      <h3 class="why-title">Intuitive Interface</h3>
      <p class="why-desc">Navigate seamlessly through a platform designed to feel effortless — so you can focus entirely on what matters most.</p>
    </div>
  </div>
</section>

{{-- ══════ TESTIMONIAL ══════ --}}
<div class="testi-strip">
  <blockquote>
    "Working with my therapist through Relief has been truly transformative. I finally feel understood and equipped to face life's challenges."
  </blockquote>
  <cite>— Sita M., Relief Member since 2023</cite>
</div>

{{-- ══════ CTA ══════ --}}
<section class="cta-sec">
  <div class="cta-inner">
    <h2 class="cta-h2">
      Ready to Begin<br><span>Your Journey?</span>
    </h2>
    <p class="cta-sub">
      Take the first step toward a healthier, more balanced mind. Our therapists are ready to meet you — whenever you are.
    </p>
    <div class="cta-btns">
      <a href="#therapists" class="btn-cta">
        <i class="ri-user-heart-line"></i>
        Explore Therapists
      </a>
      <a href="{{ route('about') }}" class="btn-cta-ol">
        <i class="ri-information-line"></i>
        Learn More
      </a>
    </div>
  </div>
</section>

@endsection