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
    .hero-orb { position: absolute; border-radius: 50%; filter: blur(60px); pointer-events: none; animation: floatOrb 7s ease-in-out infinite alternate; }
    @keyframes floatOrb { from { transform: translate(0,0) scale(1); } to { transform: translate(14px,-10px) scale(1.07); } }
    .hero-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(59,130,246,0.15); border: 1px solid rgba(96,165,250,0.25); color: #93c5fd; border-radius: 999px; padding: 5px 14px; font-size: 0.68rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 0.85rem; backdrop-filter: blur(10px); }

    .info-card { background: white; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 24px rgba(0,0,0,0.05); overflow: hidden; }
    .info-card-accent { height: 5px; background: linear-gradient(90deg, #3b82f6, #6366f1, #8b5cf6); }

    .form-card { background: white; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 24px rgba(0,0,0,0.05); overflow: hidden; }
    .form-card-header { padding: 1.5rem 1.75rem; border-bottom: 1px solid #f1f5f9; background: #f8fafc; }

    .field-wrap { margin-bottom: 1.5rem; }
    .field-label { display: flex; align-items: center; gap: 7px; font-size: 0.8rem; font-weight: 700; color: #374151; margin-bottom: 0.5rem; letter-spacing: 0.01em; }
    .field-label i { color: #6366f1; font-size: 0.9rem; }
    .field-input { width: 100%; padding: 0.8rem 1rem; font-size: 0.875rem; color: #1e293b; font-family: 'DM Sans', sans-serif; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 0.75rem; outline: none; transition: all 0.2s ease; }
    .field-input:focus { border-color: #6366f1; background: white; box-shadow: 0 0 0 3px rgba(99,102,241,0.12); }

    .submit-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 0.9rem 2rem; font-size: 0.9rem; font-weight: 700; font-family: 'DM Sans', sans-serif; color: white; background: linear-gradient(135deg, #3b82f6, #6366f1); border: none; border-radius: 0.85rem; cursor: pointer; box-shadow: 0 4px 16px rgba(99,102,241,0.35); transition: all 0.25s ease; position: relative; overflow: hidden; }
    .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(99,102,241,0.4); }
    .submit-btn:disabled { opacity:0.6; cursor:not-allowed; transform:none; }

    .back-link { display: inline-flex; align-items: center; gap: 6px; color: #93c5fd; font-size: 0.78rem; font-weight: 600; text-decoration: none; letter-spacing: 0.03em; transition: color 0.2s ease; margin-bottom: 1.5rem; }
    .back-link:hover { color: #bfdbfe; }

    .avatar { width: 48px; height: 48px; border-radius: 999px; background: linear-gradient(135deg, #dbeafe, #ede9fe); display: flex; align-items: center; justify-content: center; color: #4f46e5; font-size: 1rem; font-weight: 700; flex-shrink: 0; }
    .info-chip { display: flex; flex-direction: column; gap: 2px; background: #f8fafc; border-radius: 10px; padding: 0.65rem 0.9rem; }
    .info-chip-label { font-size: 0.62rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.08em; }
    .info-chip-val { font-size: 0.83rem; font-weight: 600; color: #1e293b; }

    .error-block { background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444; border-radius: 0.75rem; padding: 1rem 1.25rem; margin-bottom: 1.5rem; }
    .error-block li { font-size: 0.83rem; color: #dc2626; margin-bottom: 3px; }

    .rv { opacity: 0; transform: translateY(18px); transition: opacity 0.5s ease, transform 0.5s ease; }
    .rv.vis { opacity: 1; transform: translateY(0); }
    .rv-d1 { transition-delay: 0.05s; } .rv-d2 { transition-delay: 0.12s; } .rv-d3 { transition-delay: 0.2s; }

    /* ===== SLOT PICKER ===== */
    .slot-section { margin-bottom: 1.5rem; }
    .slot-section-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:0.6rem; }
    #slotHint { font-size:0.75rem; color:#6b7280; font-style:italic; font-weight:400; }

    .slot-skeleton { display:grid; grid-template-columns:repeat(auto-fill,minmax(90px,1fr)); gap:0.5rem; }
    .slot-skeleton-item { height:40px; background:linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%); background-size:200% 100%; border-radius:9px; animation:shimmer 1.4s infinite; }
    @keyframes shimmer { 0%{background-position:200% 0;} 100%{background-position:-200% 0;} }

    .slots-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(90px,1fr)); gap:0.5rem; }

    .slot-btn { padding:0.55rem 0.5rem; border:1.5px solid #e5e7eb; border-radius:9px; font-size:0.8rem; font-weight:600; font-family:'DM Sans',sans-serif; background:#fafaf8; color:#374151; cursor:pointer; transition:all 0.18s ease; text-align:center; position:relative; line-height:1.2; }
    .slot-btn:hover:not(.taken):not(.past) { border-color:#6366f1; background:#eef2ff; color:#4f46e5; transform:translateY(-1px); box-shadow:0 3px 10px rgba(99,102,241,0.18); }
    .slot-btn.selected { border-color:#6366f1; background:#6366f1; color:#fff; box-shadow:0 4px 14px rgba(99,102,241,0.35); transform:translateY(-1px); }
    .slot-btn.taken { border-color:#fecaca; background:#fff5f5; color:#fca5a5; cursor:not-allowed; text-decoration:line-through; }
    .slot-btn.past { border-color:#e5e7eb; background:#f9fafb; color:#d1d5db; cursor:not-allowed; }
    .slot-btn.taken::after { content:'Full'; display:block; font-size:0.58rem; color:#ef4444; text-decoration:none; }
    .slot-btn.past::after { content:'Past'; display:block; font-size:0.58rem; color:#9ca3af; }
    .slot-btn.current-slot { border-color:#f59e0b; background:#fffbeb; color:#92400e; }
    .slot-btn.current-slot::after { content:'Current'; display:block; font-size:0.58rem; color:#f59e0b; }

    .no-slots-msg { text-align:center; padding:1.5rem 1rem; background:#f8fafc; border-radius:12px; border:1.5px dashed #e5e7eb; color:#6b7280; font-size:0.85rem; }
    .no-slots-msg i { display:block; font-size:1.5rem; margin-bottom:0.4rem; color:#d1d5db; }

    .field-error { color:#ef4444; font-size:0.75rem; margin-top:0.3rem; display:none; align-items:center; gap:0.3rem; }
    .field-error.show { display:flex; }

    @media (max-width: 640px) { .page-hero { padding: 2.5rem 1rem 5rem; } .form-body { padding: 1.25rem; } }
</style>

<section class="page-hero">
    <div class="hero-orb w-56 h-56 bg-blue-600" style="top:-30px; left:-50px; opacity:0.2;"></div>
    <div class="hero-orb w-44 h-44 bg-indigo-600" style="bottom:15px; right:-20px; opacity:0.18; animation-delay:-3.5s;"></div>
    <div class="relative z-10 max-w-2xl mx-auto text-center">
        <div class="hero-badge"><i class="ri-edit-line"></i> Reschedule</div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-3" style="font-family:'Playfair Display',serif; line-height:1.15;">Update Appointment</h1>
        <p class="text-sm sm:text-base text-blue-200/70 max-w-md mx-auto leading-relaxed">Choose a new date and time from the therapist's available slots.</p>
    </div>
</section>

<section class="py-12 sm:py-16 bg-slate-50 -mt-1">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">

        <a href="{{ route('bookings.index') }}" class="back-link rv vis">
            <i class="ri-arrow-left-line"></i> Back to My Bookings
        </a>

        @if ($errors->any())
        <div class="error-block rv vis">
            <div class="flex items-center gap-2 mb-2">
                <i class="ri-error-warning-line text-red-500"></i>
                <p class="text-sm font-bold text-red-700">Please fix the following:</p>
            </div>
            <ul class="pl-4 list-disc">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        {{-- Current Booking Info Card --}}
        <div class="info-card mb-5 rv rv-d1">
            <div class="info-card-accent"></div>
            <div class="p-5 sm:p-6">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Current Booking Details</p>
                <div class="flex items-center gap-3 mb-4">
                    <div class="avatar">{{ Str::substr($booking->therapist->name ?? 'T', 0, 1) }}</div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $booking->therapist->name ?? 'Therapist' }}</p>
                        <p class="text-xs text-gray-400">Therapist · Rs. {{ $booking->therapist->fee ?? '0.00' }}</p>
                    </div>
                    <span class="ml-auto inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        {{ $booking->status }}
                    </span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    <div class="info-chip">
                        <span class="info-chip-label"><i class="ri-calendar-line mr-0.5"></i> Date</span>
                        <span class="info-chip-val">{{ is_string($booking->booking_date) ? $booking->booking_date : $booking->booking_date->format('Y-m-d') }}</span>
                    </div>
                    <div class="info-chip">
                        <span class="info-chip-label"><i class="ri-time-line mr-0.5"></i> Time</span>
                        <span class="info-chip-val">{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</span>
                    </div>
                    <div class="info-chip">
                        <span class="info-chip-label"><i class="ri-user-line mr-0.5"></i> Name</span>
                        <span class="info-chip-val">{{ $booking->name }}</span>
                    </div>
                </div>

                {{-- Therapist working days summary --}}
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Therapist Availability</p>
                    <div class="flex flex-wrap gap-1.5">
                        @forelse($therapist->schedules as $sch)
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                            <i class="ri-calendar-check-line text-green-500"></i>
                            {{ $sch->day_of_week }}
                            <span class="text-green-500 font-normal ml-0.5">
                                {{ \Carbon\Carbon::parse($sch->start_time)->format('h A') }}–{{ \Carbon\Carbon::parse($sch->end_time)->format('h A') }}
                            </span>
                        </span>
                        @empty
                        <span class="text-xs text-gray-400">No schedule set</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Reschedule Form --}}
        <div class="form-card rv rv-d2">
            <div class="info-card-accent"></div>
            <div class="form-card-header">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center">
                        <i class="ri-calendar-todo-line text-indigo-500"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-gray-900">Select New Date & Time</h2>
                        <p class="text-xs text-gray-400">Choose a date, then pick from available slots</p>
                    </div>
                </div>
            </div>

            <div class="form-body p-6 sm:p-7">
                <form id="rescheduleForm" action="{{ route('bookings.update', $booking->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Hidden time value submitted with form --}}
                    <input type="hidden" name="booking_time" id="booking_time" value="{{ old('booking_time') }}">

                    <div class="field-wrap">
                        <label for="booking_date" class="field-label">
                            <i class="ri-calendar-event-line"></i>
                            New Date
                        </label>
                        <input
                            type="date"
                            name="booking_date"
                            id="booking_date"
                            value="{{ old('booking_date', is_string($booking->booking_date) ? $booking->booking_date : $booking->booking_date->format('Y-m-d')) }}"
                            min="{{ now()->toDateString() }}"
                            required
                            class="field-input"
                        >
                        <span class="field-error" id="dateError">Please select a valid date.</span>
                    </div>

                    {{-- DYNAMIC SLOT PICKER --}}
                    <div class="slot-section">
                        <div class="slot-section-header">
                            <label class="field-label" style="margin-bottom:0;"><i class="ri-time-line"></i> Available Slots</label>
                            <span id="slotHint">Select a date to see available slots</span>
                        </div>

                        <div id="slotSkeleton" class="slot-skeleton" style="display:none;">
                            @for($i=0;$i<8;$i++)
                            <div class="slot-skeleton-item"></div>
                            @endfor
                        </div>

                        <div id="slotsGrid" class="slots-grid"></div>

                        <div id="noSlotsMsg" class="no-slots-msg" style="display:none;">
                            <i class="ri-calendar-close-line"></i>
                            <span id="noSlotsMsgText">No slots available for this date.</span>
                        </div>

                        <span class="field-error" id="timeError" style="margin-top:0.4rem;">Please select a time slot.</span>
                    </div>

                    <div class="flex items-start gap-2.5 bg-blue-50 border border-blue-100 rounded-xl p-3.5 mb-6">
                        <i class="ri-information-line text-blue-400 text-base mt-0.5 shrink-0"></i>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            Your appointment status will return to <strong>Pending</strong> after rescheduling and will need to be re-confirmed by the admin.
                        </p>
                    </div>

                    <button type="submit" id="submitBtn" class="submit-btn">
                        <i class="ri-calendar-check-line"></i>
                        Confirm Reschedule
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

<script>
(function(){
    const BOOKING_ID    = {{ $booking->id }};
    const THERAPIST_ID  = {{ $booking->therapist_id }};
    // The slot endpoint that excludes current booking from taken list
    const SLOTS_URL     = "{{ route('bookings.slots.edit', $booking->id) }}";
    const CURRENT_TIME  = "{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}";
    const OLD_TIME      = "{{ old('booking_time') }}";

    const dateInput  = document.getElementById('booking_date');
    const hiddenTime = document.getElementById('booking_time');
    const slotsGrid  = document.getElementById('slotsGrid');
    const skeleton   = document.getElementById('slotSkeleton');
    const noSlotsMsg = document.getElementById('noSlotsMsg');
    const noSlotsTxt = document.getElementById('noSlotsMsgText');
    const slotHint   = document.getElementById('slotHint');

    let currentSelectedTime = OLD_TIME || '';

    // ── Helpers ───────────────────────────────────────────────────────────
    const show = (id, txt) => {
        const el = document.getElementById(id);
        if (!el) return;
        if (txt) { el.textContent = txt; el.classList.add('show'); }
        else      { el.classList.remove('show'); }
    };

    dateInput.addEventListener('change', function(){
        const today = new Date().toISOString().split('T')[0];
        if (!this.value || this.value < today) {
            show('dateError', 'Please select a valid date.');
            clearSlots();
            return;
        }
        show('dateError', '');
        fetchSlots(this.value);
    });

    function clearSlots() {
        slotsGrid.innerHTML      = '';
        noSlotsMsg.style.display = 'none';
        skeleton.style.display   = 'none';
        slotHint.textContent     = 'Select a date to see available slots';
        hiddenTime.value         = '';
        currentSelectedTime      = '';
    }

    function showSkeleton() {
        skeleton.style.display   = 'grid';
        slotsGrid.innerHTML      = '';
        noSlotsMsg.style.display = 'none';
        slotHint.textContent     = 'Loading slots…';
    }

    function fetchSlots(date) {
        showSkeleton();

        const url = SLOTS_URL + '?therapist_id=' + THERAPIST_ID + '&date=' + date;

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
        .then(r => r.json())
        .then(data => {
            skeleton.style.display = 'none';

            if (!data.slots || data.slots.length === 0) {
                noSlotsTxt.textContent   = data.message || 'No available slots for this date.';
                noSlotsMsg.style.display = 'block';
                slotsGrid.innerHTML      = '';
                slotHint.textContent     = '';
                hiddenTime.value         = '';
                return;
            }

            noSlotsMsg.style.display = 'none';
            const available = data.slots.filter(s => s.available).length;
            slotHint.textContent = available + ' slot' + (available === 1 ? '' : 's') + ' available — ' + data.day;

            renderSlots(data.slots, date);
        })
        .catch(() => {
            skeleton.style.display   = 'none';
            noSlotsTxt.textContent   = 'Failed to load slots. Please try again.';
            noSlotsMsg.style.display = 'block';
            slotHint.textContent     = '';
        });
    }

    function isSameDate(date) {
        const currentDate = "{{ is_string($booking->booking_date) ? $booking->booking_date : $booking->booking_date->format('Y-m-d') }}";
        return date === currentDate;
    }

    function renderSlots(slots, date) {
        slotsGrid.innerHTML = '';
        const sameDateAsOrig = isSameDate(date);

        slots.forEach(slot => {
            const btn = document.createElement('button');
            btn.type          = 'button';
            btn.dataset.time  = slot.time;
            btn.textContent   = slot.label;
            btn.className     = 'slot-btn';

            const isCurrentSlot = sameDateAsOrig && slot.time === CURRENT_TIME;

            if (!slot.available && !isCurrentSlot) {
                btn.classList.add(slot.reason === 'past' ? 'past' : 'taken');
                btn.disabled = true;
            } else {
                // Highlight the current booking's slot
                if (isCurrentSlot && !OLD_TIME) {
                    btn.classList.add('current-slot');
                    // Don't auto-select it — user must consciously choose
                }

                // Restore old selection after a validation fail redirect
                const restoreTime = OLD_TIME || '';
                if (restoreTime && slot.time === restoreTime) {
                    selectSlot(btn, slot.time);
                }

                btn.addEventListener('click', function(){
                    selectSlot(this, slot.time);
                    show('timeError', '');
                });
            }

            slotsGrid.appendChild(btn);
        });
    }

    function selectSlot(btn, time) {
        slotsGrid.querySelectorAll('.slot-btn.selected').forEach(b => b.classList.remove('selected'));
        btn.classList.remove('current-slot');
        btn.classList.add('selected');
        hiddenTime.value    = time;
        currentSelectedTime = time;
    }

    // ── Form submit ───────────────────────────────────────────────────────
    document.getElementById('rescheduleForm').addEventListener('submit', function(e){
        let valid = true;
        const today = new Date().toISOString().split('T')[0];

        const date = dateInput.value;
        if (!date || date < today) { show('dateError', date ? 'Please select a future date.' : 'Please select a date.'); valid=false; }

        if (!hiddenTime.value) { show('timeError', 'Please select a time slot.'); valid=false; }

        if (!valid) {
            e.preventDefault();
            const firstError = document.querySelector('.field-error.show');
            if (firstError) firstError.scrollIntoView({ behavior:'smooth', block:'center' });
        } else {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="ri-loader-4-line spin"></i> Saving…';
        }
    });

    // ── Auto-load slots for the currently set date ────────────────────────
    if (dateInput.value) {
        fetchSlots(dateInput.value);
    }

    // ── Scroll reveal ─────────────────────────────────────────────────────
    const rvEls = document.querySelectorAll('.rv:not(.vis)');
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('vis'); });
    }, { threshold: 0.06 });
    rvEls.forEach(el => obs.observe(el));
})();
</script>

<style>
    @keyframes spin { to { transform:rotate(360deg); } }
    .spin { display:inline-block; animation:spin 0.8s linear infinite; }
</style>
@endsection