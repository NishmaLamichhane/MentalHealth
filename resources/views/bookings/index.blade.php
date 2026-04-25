@extends('layouts.master')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap');

    /* ===== PAGE HERO ===== */
    .page-hero {
        position: relative;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1e1b4b 100%);
        overflow: hidden;
        padding: 4rem 1.5rem 5rem;
    }
    .page-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .page-hero::after {
        content: '';
        position: absolute; bottom: -1px; left: 0; right: 0; height: 80px;
        background: linear-gradient(to top, #f8fafc, transparent);
    }
    .hero-orb {
        position: absolute; border-radius: 50%; filter: blur(60px); pointer-events: none;
        animation: floatOrb 8s ease-in-out infinite alternate;
    }
    @keyframes floatOrb {
        from { transform: translate(0,0) scale(1); }
        to { transform: translate(16px,-12px) scale(1.08); }
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(59,130,246,0.15); border: 1px solid rgba(96,165,250,0.25);
        color: #93c5fd; border-radius: 999px; padding: 5px 14px;
        font-size: 0.7rem; font-weight: 600; letter-spacing: 0.1em;
        text-transform: uppercase; margin-bottom: 1rem;
        backdrop-filter: blur(10px);
    }

    /* ===== STAT PILLS ===== */
    .stats-row {
        display: flex; flex-wrap: wrap; gap: 0.75rem;
        justify-content: center; margin-bottom: 2.5rem;
    }
    .stat-pill {
        display: inline-flex; align-items: center; gap: 10px;
        background: white; border: 1px solid #e2e8f0;
        border-radius: 1rem; padding: 0.65rem 1.25rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
    }
    .stat-pill:hover { border-color: #bfdbfe; box-shadow: 0 6px 20px rgba(59,130,246,0.1); transform: translateY(-1px); }
    .stat-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; font-size: 0.95rem;
        flex-shrink: 0;
    }

    /* ===== TABLE ===== */
    .table-card {
        background: white; border: 1px solid #e2e8f0;
        border-radius: 1.25rem; overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    }
    .tbl { width: 100%; border-collapse: separate; border-spacing: 0; }
    .tbl thead th {
        background: #f8fafc; padding: 0.85rem 1.1rem;
        font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.08em; color: #64748b;
        text-align: left; border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }
    .tbl thead th:first-child { border-radius: 0; }
    .tbl tbody td {
        padding: 1rem 1.1rem; font-size: 0.855rem; color: #334155;
        border-bottom: 1px solid #f1f5f9; vertical-align: middle;
    }
    .tbl tbody tr { transition: background 0.15s; }
    .tbl tbody tr:hover { background: #f8fafc; }
    .tbl tbody tr:last-child td { border-bottom: none; }

    /* ===== AVATAR ===== */
    .avatar {
        width: 36px; height: 36px; border-radius: 999px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        display: flex; align-items: center; justify-content: center;
        color: #4f46e5; font-size: 0.8rem; font-weight: 700; flex-shrink: 0;
    }

    /* ===== BADGES (UPDATED TO MATCH CONTROLLER) ===== */
    .badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 11px; border-radius: 999px;
        font-size: 0.68rem; font-weight: 700; white-space: nowrap; letter-spacing: 0.03em;
    }
    .badge-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    
    .badge-pending  { background: #fef9c3; color: #854d0e; }
    .badge-pending .badge-dot  { background: #eab308; }
    
    .badge-processing { background: #e0f2fe; color: #0369a1; }
    .badge-processing .badge-dot { background: #0ea5e9; }
    
    .badge-approved { background: #d1fae5; color: #065f46; }
    .badge-approved .badge-dot { background: #10b981; }
    
    .badge-rejected { background: #fee2e2; color: #991b1b; }
    .badge-rejected .badge-dot { background: #ef4444; }

    /* ===== ACTION BUTTONS ===== */
    .act-btn {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.78rem; font-weight: 600; padding: 5px 11px;
        border-radius: 8px; transition: all 0.2s ease; text-decoration: none;
        border: none; cursor: pointer; background: none;
    }
    .act-reschedule { color: #2563eb; background: #eff6ff; }
    .act-reschedule:hover { background: #dbeafe; color: #1d4ed8; }
    .act-cancel { color: #dc2626; background: #fef2f2; }
    .act-cancel:hover { background: #fee2e2; color: #b91c1c; }

    /* ===== MOBILE CARDS ===== */
    .m-card {
        background: white; border: 1px solid #e2e8f0;
        border-radius: 1.25rem; overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
    }
    .m-card:hover { box-shadow: 0 8px 28px rgba(59,130,246,0.1); border-color: #bfdbfe; }
    .m-card-top {
        height: 5px;
        background: linear-gradient(90deg, #3b82f6, #6366f1, #8b5cf6);
    }
    .detail-chip {
        background: #f8fafc; border-radius: 10px;
        padding: 0.65rem 0.85rem;
    }
    .detail-label {
        font-size: 0.65rem; font-weight: 700; color: #94a3b8;
        text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 2px;
    }
    .detail-val { font-size: 0.83rem; font-weight: 600; color: #1e293b; }

    /* ===== MODAL ===== */
    .cmodal {
        position: fixed; inset: 0; z-index: 200;
        background: rgba(15,23,42,0.65); backdrop-filter: blur(8px);
        display: flex; align-items: center; justify-content: center; padding: 1rem;
        opacity: 0; visibility: hidden;
        transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
    }
    .cmodal.open { opacity: 1; visibility: visible; }
    .cmodal-box {
        background: white; border-radius: 1.5rem; width: 100%; max-width: 400px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.2);
        transform: scale(0.9) translateY(20px);
        transition: transform 0.25s cubic-bezier(0.4,0,0.2,1);
        overflow: hidden;
    }
    .cmodal.open .cmodal-box { transform: scale(1) translateY(0); }

    /* ===== FLASH ===== */
    .flash-success {
        display: flex; align-items: center; gap: 12px;
        background: #f0fdf4; border: 1px solid #bbf7d0;
        border-left: 4px solid #22c55e;
        color: #15803d; padding: 1rem 1.25rem;
        border-radius: 0.75rem; margin-bottom: 1.75rem;
        font-size: 0.875rem; font-weight: 500;
        animation: slideIn 0.3s ease;
    }
    @keyframes slideIn { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }

    /* ===== EMPTY STATE ===== */
    .empty-state { text-align: center; padding: 5rem 1.5rem; }
    .empty-icon {
        width: 90px; height: 90px; border-radius: 50%;
        background: linear-gradient(135deg, #eff6ff, #eef2ff);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.5rem; font-size: 2rem; color: #93c5fd;
    }

    /* ===== REVEAL ANIMATION ===== */
    .rv { opacity: 0; transform: translateY(18px); transition: opacity 0.5s ease, transform 0.5s ease; }
    .rv.vis { opacity: 1; transform: translateY(0); }
    .rv-d1 { transition-delay: 0.05s; }
    .rv-d2 { transition-delay: 0.1s; }
    .rv-d3 { transition-delay: 0.15s; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 767px) { .desktop-only { display: none !important; } }
    @media (min-width: 768px) { .mobile-only { display: none !important; } }

    @media (max-width: 480px) {
        .stat-pill { padding: 0.55rem 0.9rem; gap: 8px; }
        .stat-icon { width: 30px; height: 30px; font-size: 0.8rem; }
    }
</style>


<section class="page-hero">
    <div class="hero-orb w-64 h-64 bg-blue-600" style="top:-40px; left:-60px; opacity:0.18;"></div>
    <div class="hero-orb w-48 h-48 bg-indigo-600" style="bottom:10px; right:-30px; opacity:0.15; animation-delay:-4s;"></div>

    <div class="relative z-10 max-w-3xl mx-auto text-center">
        <div class="hero-badge">
            <i class="ri-calendar-check-line"></i>
            My Appointments
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-3" style="font-family:'Playfair Display',serif; line-height:1.15;">
            Your Bookings
        </h1>
        <p class="text-sm sm:text-base text-blue-200/70 max-w-lg mx-auto leading-relaxed">
            Track, manage, and stay on top of your wellness appointments — all in one place.
        </p>
    </div>
</section>


<section class="py-12 sm:py-16 bg-slate-50 -mt-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Flash --}}
        @if (session('success'))
        <div class="flash-success rv vis">
            <span class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                <i class="ri-check-line text-sm"></i>
            </span>
            {{ session('success') }}
        </div>
        @endif

        {{-- Stats (UPDATED TO MATCH CONTROLLER) --}}
        @php
            $total    = $bookings->count();
            $pending  = $bookings->where('status', 'Pending')->count();
            $approved = $bookings->where('status', 'Approved')->count();
        @endphp

        <div class="stats-row rv rv-d1">
            <div class="stat-pill">
                <div class="stat-icon" style="background:#eff6ff;">
                    <i class="ri-file-list-3-line" style="color:#3b82f6;"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-gray-900 leading-none">{{ $total }}</span>
                    <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold">Total</span>
                </div>
            </div>
            <div class="stat-pill">
                <div class="stat-icon" style="background:#fffbeb;">
                    <i class="ri-time-line" style="color:#f59e0b;"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-amber-500 leading-none">{{ $pending }}</span>
                    <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold">Pending</span>
                </div>
            </div>
            <div class="stat-pill">
                <div class="stat-icon" style="background:#f0fdf4;">
                    <i class="ri-checkbox-circle-line" style="color:#22c55e;"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-emerald-500 leading-none">{{ $approved }}</span>
                    <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold">Approved</span>
                </div>
            </div>
        </div>


        @if ($bookings->count() > 0)

        {{-- DESKTOP TABLE --}}
        <div class="desktop-only table-card rv rv-d2">
            <div class="overflow-x-auto">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Therapist</th>
                            <th>Date & Time</th>
                            <th>Contact</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                        @php $sc = 'badge-' . strtolower($booking->status); @endphp
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">{{ Str::substr($booking->therapist->name ?? 'T', 0, 1) }}</div>
                                    <div>
                                        <p class="font-semibold text-gray-900 text-sm">{{ $booking->therapist->name }}</p>
                                        <p class="text-xs text-gray-400">Therapist</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="font-semibold text-gray-900 text-sm">{{ $booking->booking_date }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $booking->booking_time }}</p>
                            </td>
                            <td>
                                <p class="text-sm text-gray-700 font-medium">{{ $booking->name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $booking->email }}</p>
                            </td>
                            <td>
                                <span class="text-sm font-bold text-gray-900">Rs. {{ $booking->therapist->fee }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $sc }}">
                                    <span class="badge-dot"></span>
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td>
                                @if ($booking->status == 'Pending')
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="act-btn act-reschedule">
                                        <i class="ri-edit-line text-xs"></i>
                                        <span>Reschedule</span>
                                    </a>
                                    <button onclick="showCancelPopup('{{ $booking->id }}')" class="act-btn act-cancel">
                                        <i class="ri-close-circle-line text-xs"></i>
                                        <span>Cancel</span>
                                    </button>
                                </div>
                                @else
                                <span class="text-xs text-gray-400 italic">No actions</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MOBILE CARDS --}}
        <div class="mobile-only space-y-4">
            @foreach ($bookings as $booking)
            @php $sc = 'badge-' . strtolower($booking->status); @endphp
            <div class="m-card rv vis">
                <div class="m-card-top"></div>
                <div class="p-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="avatar w-11 h-11 text-sm">{{ Str::substr($booking->therapist->name ?? 'T', 0, 1) }}</div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm leading-tight">{{ $booking->therapist->name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">Therapist</p>
                            </div>
                        </div>
                        <span class="badge {{ $sc }}">
                            <span class="badge-dot"></span>
                            {{ $booking->status }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mb-3">
                        <div class="detail-chip">
                            <div class="detail-label"><i class="ri-calendar-line"></i> Date</div>
                            <div class="detail-val">{{ $booking->booking_date }}</div>
                        </div>
                        <div class="detail-chip">
                            <div class="detail-label"><i class="ri-time-line"></i> Time</div>
                            <div class="detail-val">{{ $booking->booking_time }}</div>
                        </div>
                        <div class="detail-chip">
                            <div class="detail-label"><i class="ri-user-line"></i> Name</div>
                            <div class="detail-val">{{ $booking->name }}</div>
                        </div>
                        <div class="detail-chip">
                            <div class="detail-label"><i class="ri-money-dollar-circle-line"></i> Fee</div>
                            <div class="detail-val text-indigo-600">Rs. {{ $booking->therapist->fee }}</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 text-xs text-gray-400 px-1 mb-4">
                        <span class="flex items-center gap-1 min-w-0">
                            <i class="ri-mail-line text-gray-300 shrink-0"></i>
                            <span class="truncate">{{ $booking->email }}</span>
                        </span>
                        <span class="flex items-center gap-1 shrink-0">
                            <i class="ri-phone-line text-gray-300"></i>
                            {{ $booking->phone }}
                        </span>
                    </div>

                    @if ($booking->status == 'Pending')
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="act-btn act-reschedule justify-center">
                            <i class="ri-edit-line text-xs"></i> Reschedule
                        </a>
                        <button onclick="showCancelPopup('{{ $booking->id }}')" class="act-btn act-cancel justify-center">
                            <i class="ri-close-circle-line text-xs"></i> Cancel
                        </button>
                    </div>
                    @else
                    <p class="text-center text-xs text-gray-400 italic py-1">No actions available</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        @else

        <div class="empty-state rv vis">
            <div class="empty-icon">
                <i class="ri-calendar-check-line"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-400 mb-2" style="font-family:'Playfair Display',serif;">No Bookings Yet</h3>
            <p class="text-sm text-gray-400 max-w-sm mx-auto mb-7 leading-relaxed">
                You haven't booked any appointments. Find a therapist and start your wellness journey today.
            </p>
            <a href="{{ route('home') }}#therapists"
               class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 px-7 py-3 rounded-full shadow-lg shadow-blue-200 transition-all duration-300 hover:shadow-blue-300 hover:-translate-y-0.5">
                <i class="ri-user-heart-line"></i>
                Find a Therapist
            </a>
        </div>

        @endif

    </div>
</section>


<div id="cancelPopup" class="cmodal" onclick="if(event.target===this)hideCancelPopup()">
    <div class="cmodal-box">
        <div style="height:5px; background:linear-gradient(90deg,#ef4444,#f97316);"></div>
        <div class="p-7 text-center">
            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
                <i class="ri-error-warning-line text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2" style="font-family:'Playfair Display',serif;">Cancel Appointment?</h3>
            <p class="text-sm text-gray-500 mb-7 leading-relaxed max-w-xs mx-auto">
                This can't be undone. Your slot will be released and available for others to book.
            </p>
            <form id="cancelForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-center gap-3">
                    <button type="button" onclick="hideCancelPopup()"
                            class="px-6 py-2.5 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">
                        Go Back
                    </button>
                    <button type="submit"
                            class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 shadow-md shadow-red-200 transition-all duration-300">
                        Yes, Cancel It
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function showCancelPopup(id) {
        document.getElementById('cancelPopup').classList.add('open');
        document.body.style.overflow = 'hidden';
        document.getElementById('cancelForm').action = "/bookings/" + id;
    }
    function hideCancelPopup() {
        document.getElementById('cancelPopup').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') hideCancelPopup(); });

    // Scroll reveal
    const rvEls = document.querySelectorAll('.rv:not(.vis)');
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('vis'); });
    }, { threshold: 0.06 });
    rvEls.forEach(el => obs.observe(el));

    // Auto-hide flash
    @if(session('success'))
    setTimeout(() => {
        const f = document.querySelector('.flash-success');
        if (f) { f.style.opacity = '0'; f.style.transform = 'translateY(-8px)'; f.style.transition = 'all 0.4s ease'; setTimeout(()=>f.remove(), 400); }
    }, 5000);
    @endif
</script>

@endsection