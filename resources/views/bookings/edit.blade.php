@extends('layouts.master')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap');

    /* ===== PAGE HERO ===== */
    .page-hero {
        position: relative;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 55%, #1e1b4b 100%);
        overflow: hidden;
        padding: 3.5rem 1.5rem 5.5rem;
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
        to { transform: translate(14px,-10px) scale(1.07); }
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(59,130,246,0.15); border: 1px solid rgba(96,165,250,0.25);
        color: #93c5fd; border-radius: 999px; padding: 5px 14px;
        font-size: 0.68rem; font-weight: 700; letter-spacing: 0.1em;
        text-transform: uppercase; margin-bottom: 0.85rem;
        backdrop-filter: blur(10px);
    }

    /* ===== BOOKING INFO CARD ===== */
    .info-card {
        background: white; border-radius: 1.25rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 24px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .info-card-accent { height: 5px; background: linear-gradient(90deg, #3b82f6, #6366f1, #8b5cf6); }

    /* ===== FORM CARD ===== */
    .form-card {
        background: white; border-radius: 1.25rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 24px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .form-card-header {
        padding: 1.5rem 1.75rem;
        border-bottom: 1px solid #f1f5f9;
        background: #f8fafc;
    }

    /* ===== FORM FIELDS ===== */
    .field-wrap { margin-bottom: 1.5rem; }
    .field-label {
        display: flex; align-items: center; gap: 7px;
        font-size: 0.8rem; font-weight: 700; color: #374151;
        margin-bottom: 0.5rem; letter-spacing: 0.01em;
    }
    .field-label i { color: #6366f1; font-size: 0.9rem; }
    .field-input, .field-select {
        width: 100%; padding: 0.8rem 1rem;
        font-size: 0.875rem; color: #1e293b; font-family: 'DM Sans', sans-serif;
        background: #f8fafc; border: 1.5px solid #e2e8f0;
        border-radius: 0.75rem; outline: none;
        transition: all 0.2s ease;
        appearance: none; -webkit-appearance: none;
    }
    .field-input:focus, .field-select:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
    }
    .field-select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236366f1' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 2.5rem;
        cursor: pointer;
    }

    /* ===== SUBMIT BTN ===== */
    .submit-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; padding: 0.9rem 2rem;
        font-size: 0.9rem; font-weight: 700; font-family: 'DM Sans', sans-serif;
        color: white;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        border: none; border-radius: 0.85rem; cursor: pointer;
        box-shadow: 0 4px 16px rgba(99,102,241,0.35);
        transition: all 0.25s ease;
        position: relative; overflow: hidden;
    }
    .submit-btn::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
        transform: translateX(-100%);
        transition: transform 0.5s ease;
    }
    .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(99,102,241,0.4); }
    .submit-btn:hover::before { transform: translateX(100%); }
    .submit-btn:active { transform: translateY(0); }

    /* ===== BACK LINK ===== */
    .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: #93c5fd; font-size: 0.78rem; font-weight: 600;
        text-decoration: none; letter-spacing: 0.03em;
        transition: color 0.2s ease; margin-bottom: 1.5rem;
    }
    .back-link:hover { color: #bfdbfe; }

    /* ===== AVATAR ===== */
    .avatar {
        width: 48px; height: 48px; border-radius: 999px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        display: flex; align-items: center; justify-content: center;
        color: #4f46e5; font-size: 1rem; font-weight: 700; flex-shrink: 0;
    }

    /* ===== INFO CHIPS ===== */
    .info-chip {
        display: flex; flex-direction: column; gap: 2px;
        background: #f8fafc; border-radius: 10px;
        padding: 0.65rem 0.9rem;
    }
    .info-chip-label { font-size: 0.62rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.08em; }
    .info-chip-val { font-size: 0.83rem; font-weight: 600; color: #1e293b; }

    /* ===== ERROR BLOCK ===== */
    .error-block {
        background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444;
        border-radius: 0.75rem; padding: 1rem 1.25rem; margin-bottom: 1.5rem;
    }
    .error-block li { font-size: 0.83rem; color: #dc2626; margin-bottom: 3px; }

    /* ===== REVEAL ===== */
    .rv { opacity: 0; transform: translateY(18px); transition: opacity 0.5s ease, transform 0.5s ease; }
    .rv.vis { opacity: 1; transform: translateY(0); }
    .rv-d1 { transition-delay: 0.05s; }
    .rv-d2 { transition-delay: 0.12s; }
    .rv-d3 { transition-delay: 0.2s; }

    @media (max-width: 640px) {
        .page-hero { padding: 2.5rem 1rem 5rem; }
        .form-body { padding: 1.25rem; }
    }
</style>


<!-- PAGE HERO -->
<section class="page-hero">
    <div class="hero-orb w-56 h-56 bg-blue-600" style="top:-30px; left:-50px; opacity:0.2;"></div>
    <div class="hero-orb w-44 h-44 bg-indigo-600" style="bottom:15px; right:-20px; opacity:0.18; animation-delay:-3.5s;"></div>

    <div class="relative z-10 max-w-2xl mx-auto text-center">
        <div class="hero-badge">
            <i class="ri-edit-line"></i>
            Reschedule
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-3" style="font-family:'Playfair Display',serif; line-height:1.15;">
            Update Appointment
        </h1>
        <p class="text-sm sm:text-base text-blue-200/70 max-w-md mx-auto leading-relaxed">
            Choose a new date and time that works best for your schedule.
        </p>
    </div>
</section>


<!-- MAIN CONTENT -->
<section class="py-12 sm:py-16 bg-slate-50 -mt-1">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">

        <!-- Back Link -->
        <a href="{{ route('bookings.index') }}" class="back-link rv vis">
            <i class="ri-arrow-left-line"></i>
            Back to My Bookings
        </a>

        @if ($errors->any())
        <div class="error-block rv vis">
            <div class="flex items-center gap-2 mb-2">
                <i class="ri-error-warning-line text-red-500"></i>
                <p class="text-sm font-bold text-red-700">Please fix the following:</p>
            </div>
            <ul class="pl-4 list-disc">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Booking Info Card -->
        <div class="info-card mb-5 rv rv-d1">
            <div class="info-card-accent"></div>
            <div class="p-5 sm:p-6">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Current Booking Details</p>
                <div class="flex items-center gap-3 mb-4">
                    <div class="avatar">{{ Str::substr($booking->therapist->name ?? 'T', 0, 1) }}</div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $booking->therapist->name }}</p>
                        <p class="text-xs text-gray-400">Therapist · Rs. {{ $booking->therapist->fee }}</p>
                    </div>
                    <span class="ml-auto inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        {{ $booking->status }}
                    </span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    <div class="info-chip">
                        <span class="info-chip-label"><i class="ri-calendar-line mr-0.5"></i> Date</span>
                        <span class="info-chip-val">{{ $booking->booking_date }}</span>
                    </div>
                    <div class="info-chip">
                        <span class="info-chip-label"><i class="ri-time-line mr-0.5"></i> Time</span>
                        <span class="info-chip-val">{{ $booking->booking_time }}</span>
                    </div>
                    <div class="info-chip">
                        <span class="info-chip-label"><i class="ri-user-line mr-0.5"></i> Name</span>
                        <span class="info-chip-val">{{ $booking->name }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reschedule Form Card -->
        <div class="form-card rv rv-d2">
            <div class="info-card-accent"></div>
            <div class="form-card-header">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center">
                        <i class="ri-calendar-todo-line text-indigo-500"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-gray-900">Select New Date & Time</h2>
                        <p class="text-xs text-gray-400">Pick an available slot from the options below</p>
                    </div>
                </div>
            </div>

            <div class="form-body p-6 sm:p-7">
                <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Date Field -->
                    <div class="field-wrap">
                        <label for="booking_date" class="field-label">
                            <i class="ri-calendar-event-line"></i>
                            New Date
                        </label>
                        <input
                            type="date"
                            name="booking_date"
                            id="booking_date"
                            value="{{ old('booking_date', $booking->booking_date) }}"
                            min="{{ now()->toDateString() }}"
                            required
                            class="field-input"
                        >
                    </div>

                    <!-- Time Field -->
                    <div class="field-wrap">
                        <label for="booking_time" class="field-label">
                            <i class="ri-time-line"></i>
                            New Time Slot
                        </label>
                        <select name="booking_time" id="booking_time" required class="field-select">
                            <option value="{{ $booking->booking_time }}" selected>
                                {{ $booking->booking_time }} (current)
                            </option>
                            <option value="09:00">09:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="13:00">01:00 PM</option>
                            <option value="14:00">02:00 PM</option>
                            <option value="15:00">03:00 PM</option>
                            <option value="16:00">04:00 PM</option>
                            <option value="17:00">05:00 PM</option>
                        </select>
                    </div>

                    <!-- Info note -->
                    <div class="flex items-start gap-2.5 bg-blue-50 border border-blue-100 rounded-xl p-3.5 mb-6">
                        <i class="ri-information-line text-blue-400 text-base mt-0.5 shrink-0"></i>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            Your appointment status will return to <strong>Pending</strong> after rescheduling and will need to be confirmed again.
                        </p>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="ri-calendar-check-line"></i>
                        Confirm Reschedule
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>


<script>
    const rvEls = document.querySelectorAll('.rv:not(.vis)');
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('vis'); });
    }, { threshold: 0.06 });
    rvEls.forEach(el => obs.observe(el));
</script>

@endsection