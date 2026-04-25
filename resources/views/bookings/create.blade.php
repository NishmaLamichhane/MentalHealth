@extends('layouts.master')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
  *, *::before, *::after { box-sizing:border-box; }
  :root { --blue:#2563eb; --blue-light:#eff6ff; --blue-mid:#3b82f6; --navy:#0d2d45; --gold:#c9974a; --soft-white:#fafaf8; }
  body { font-family:'DM Sans',sans-serif; background:var(--soft-white); }

  .booking-hero {
    background:linear-gradient(135deg, var(--navy) 0%, #174a6e 50%, #1e3a5f 100%);
    padding:2.5rem 1.5rem; text-align:center; position:relative; overflow:hidden;
  }
  .booking-hero::before {
    content:''; position:absolute; inset:0;
    background:radial-gradient(ellipse at 70% 50%, rgba(59,130,246,0.2) 0%, transparent 60%);
    pointer-events:none;
  }
  .booking-hero h1 { font-family:'Playfair Display',serif; font-size:clamp(1.5rem,4vw,2.4rem); color:#fff; margin-bottom:0.4rem; position:relative; z-index:1; }
  .booking-hero p { color:rgba(255,255,255,0.65); font-size:0.9rem; position:relative; z-index:1; }

  .booking-layout { max-width:860px; margin:2.5rem auto 4rem; padding:0 1.25rem; display:grid; grid-template-columns:1fr 300px; gap:2rem; align-items:start; }

  .form-card { background:#fff; border-radius:24px; padding:2.25rem; box-shadow:0 6px 30px rgba(13,45,69,0.09); border:1px solid rgba(13,45,69,0.07); }
  .form-card h2 { font-family:'Playfair Display',serif; font-size:1.3rem; color:var(--navy); margin-bottom:1.75rem; padding-bottom:1rem; border-bottom:1px solid #f0f0ee; }
  .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }

  .form-group { margin-bottom:1.15rem; }
  label { display:block; font-size:0.72rem; font-weight:700; letter-spacing:0.09em; text-transform:uppercase; color:#374151; margin-bottom:0.45rem; }

  input[type=text], input[type=email], input[type=date], input[type=time], select, textarea {
    width:100%; padding:0.78rem 1rem; border:1.5px solid #e5e7eb;
    border-radius:11px; font-size:0.88rem; font-family:'DM Sans',sans-serif; color:#1f2937;
    background:var(--soft-white); outline:none; transition:border-color 0.2s, box-shadow 0.2s;
  }
  input:focus, select:focus, textarea:focus { border-color:var(--blue-mid); box-shadow:0 0 0 3px rgba(59,130,246,0.15); background:#fff; }
  input.error, select.error, textarea.error { border-color:#ef4444; box-shadow:0 0 0 3px rgba(239,68,68,0.1); }
  .field-error { color:#ef4444; font-size:0.75rem; margin-top:0.3rem; display:none; align-items:center; gap:0.3rem; }
  .field-error.show { display:flex; }
  textarea { resize:vertical; min-height:100px; }
  input[readonly] { background:#f3f4f6; color:#6b7280; cursor:default; }
  .char-count { font-size:0.72rem; color:#9ca3af; text-align:right; margin-top:0.25rem; }

  .submit-btn { width:100%; background:linear-gradient(135deg,#3b82f6,#2563eb); color:#fff; padding:1rem; border:none; border-radius:12px; font-size:1rem; font-weight:700; font-family:'DM Sans',sans-serif; cursor:pointer; box-shadow:0 6px 20px rgba(37,99,235,0.3); transition:transform 0.2s, box-shadow 0.2s; margin-top:0.5rem; display:flex; align-items:center; justify-content:center; gap:0.5rem; }
  .submit-btn:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(37,99,235,0.4); }
  .submit-btn:disabled { opacity:0.6; cursor:not-allowed; transform:none; }

  /* Sidebar info card */
  .info-card { background:#fff; border-radius:24px; padding:1.75rem; box-shadow:0 6px 30px rgba(13,45,69,0.09); border:1px solid rgba(13,45,69,0.07); position:sticky; top:2rem; }
  .therapist-mini { display:flex; align-items:center; gap:0.9rem; margin-bottom:1.5rem; padding-bottom:1.25rem; border-bottom:1px solid #f0f0ee; }
  .therapist-mini img { width:56px; height:56px; border-radius:14px; object-fit:cover; }
  .therapist-mini-name { font-family:'Playfair Display',serif; font-size:1rem; color:var(--navy); }
  .therapist-mini-spec { font-size:0.78rem; color:var(--blue-mid); font-weight:600; }
  .info-row { display:flex; gap:0.6rem; margin-bottom:1rem; }
  .info-row-icon { width:32px; height:32px; background:var(--blue-light); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
  .info-row-icon svg { width:15px; height:15px; color:var(--blue-mid); }
  .info-row-label { font-size:0.72rem; color:#9ca3af; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; }
  .info-row-val { font-size:0.88rem; color:var(--navy); font-weight:600; }
  .fee-highlight { background:var(--blue-light); border-radius:10px; padding:0.8rem 1rem; text-align:center; margin-top:1rem; }
  .fee-highlight .amount { font-family:'Playfair Display',serif; font-size:1.5rem; color:var(--blue-mid); }
  .fee-highlight .fee-label { font-size:0.72rem; color:#3b82f6; text-transform:uppercase; letter-spacing:0.1em; }

  /* Server-side errors */
  .alert-errors { background:#fef2f2; border:1px solid #fecaca; border-radius:12px; padding:1rem 1.25rem; margin-bottom:1.5rem; }
  .alert-errors p { color:#991b1b; font-size:0.83rem; font-weight:600; margin-bottom:0.35rem; }
  .alert-errors ul { list-style:none; }
  .alert-errors li { color:#b91c1c; font-size:0.8rem; padding:0.15rem 0; display:flex; align-items:center; gap:0.4rem; }

  /* ===================== SLOT PICKER STYLES ===================== */
  .slot-section { margin-bottom:1.15rem; }

  .slot-section-header {
    display:flex; align-items:center; justify-content:space-between;
    margin-bottom:0.6rem;
  }

  #slotHint {
    font-size:0.75rem; color:#6b7280; font-style:italic; font-weight:400;
  }

  /* Loading skeleton */
  .slot-skeleton {
    display:grid; grid-template-columns:repeat(auto-fill,minmax(90px,1fr)); gap:0.5rem;
  }
  .slot-skeleton-item {
    height:40px; background:linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%);
    background-size:200% 100%; border-radius:9px;
    animation:shimmer 1.4s infinite;
  }
  @keyframes shimmer { 0%{background-position:200% 0;} 100%{background-position:-200% 0;} }

  /* Slot grid */
  .slots-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(90px,1fr));
    gap:0.5rem;
  }

  .slot-btn {
    padding:0.55rem 0.5rem;
    border:1.5px solid #e5e7eb;
    border-radius:9px;
    font-size:0.8rem;
    font-weight:600;
    font-family:'DM Sans',sans-serif;
    background:#fafaf8;
    color:#374151;
    cursor:pointer;
    transition:all 0.18s ease;
    text-align:center;
    position:relative;
    line-height:1.2;
  }
  .slot-btn:hover:not(.taken):not(.past) {
    border-color:var(--blue-mid);
    background:var(--blue-light);
    color:var(--blue);
    transform:translateY(-1px);
    box-shadow:0 3px 10px rgba(59,130,246,0.18);
  }
  .slot-btn.selected {
    border-color:var(--blue);
    background:var(--blue);
    color:#fff;
    box-shadow:0 4px 14px rgba(37,99,235,0.35);
    transform:translateY(-1px);
  }
  .slot-btn.taken {
    border-color:#fecaca;
    background:#fff5f5;
    color:#fca5a5;
    cursor:not-allowed;
    text-decoration:line-through;
  }
  .slot-btn.past {
    border-color:#e5e7eb;
    background:#f9fafb;
    color:#d1d5db;
    cursor:not-allowed;
  }

  /* Badge on taken slot */
  .slot-btn.taken::after {
    content:'Full';
    display:block;
    font-size:0.58rem;
    color:#ef4444;
    text-decoration:none;
    letter-spacing:0.05em;
  }
  .slot-btn.past::after {
    content:'Past';
    display:block;
    font-size:0.58rem;
    color:#9ca3af;
    letter-spacing:0.05em;
  }

  /* No-slots message */
  .no-slots-msg {
    text-align:center;
    padding:1.5rem 1rem;
    background:#f8fafc;
    border-radius:12px;
    border:1.5px dashed #e5e7eb;
    color:#6b7280;
    font-size:0.85rem;
  }
  .no-slots-msg i { display:block; font-size:1.5rem; margin-bottom:0.4rem; color:#d1d5db; }

  /* Hidden actual input */
  #booking_time { display:none !important; }

  /* Schedule info badge in sidebar */
  .schedule-day-badge {
    display:flex; align-items:center; gap:0.5rem;
    background:#f0fdf4; border:1px solid #bbf7d0;
    border-radius:8px; padding:0.45rem 0.75rem;
    font-size:0.78rem; font-weight:600; color:#166534;
    margin-bottom:0.4rem;
  }
  .schedule-day-badge i { color:#22c55e; }

  .schedule-info-wrap { margin-top:0.75rem; }
  .schedule-info-label { font-size:0.65rem; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:0.4rem; }

  @media(max-width:768px){
    .booking-layout { grid-template-columns:1fr; }
    .info-card { position:static; }
    .form-row { grid-template-columns:1fr; gap:0; }
  }
  @media(max-width:480px){
    .form-card { padding:1.5rem 1.25rem; }
    .booking-hero { padding:2rem 1rem; }
    .slots-grid { grid-template-columns:repeat(auto-fill,minmax(76px,1fr)); }
  }
</style>

<div class="booking-hero">
  <h1>Book a Session with {{ $therapist->name }}</h1>
  <p>Fill in your details below and choose a convenient time slot.</p>
</div>

<div class="booking-layout">

  {{-- Main Form --}}
  <div class="form-card">

    @if ($errors->any())
    <div class="alert-errors">
      <p>⚠️ Please fix the following errors:</p>
      <ul>@foreach ($errors->all() as $error)<li>• {{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <h2>Your Details</h2>
    <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST" novalidate>
      @csrf
      <input type="hidden" name="therapist_id" value="{{ $therapist->id }}">

      {{-- Hidden actual time input submitted with form --}}
      <input type="hidden" name="booking_time" id="booking_time" value="{{ old('booking_time') }}">

      <div class="form-row">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name" placeholder="Your full name" value="{{ old('name') }}" required>
          <span class="field-error" id="nameError">Name is required.</span>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" name="email" id="email" placeholder="you@example.com" value="{{ old('email') }}" required>
          <span class="field-error" id="emailError">Enter a valid email address.</span>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="text" name="phone" id="phone" placeholder="10-digit number" value="{{ old('phone') }}" required>
          <span class="field-error" id="phoneError">Enter a valid 10-digit phone number.</span>
        </div>
        <div class="form-group">
          <label for="booking_date">Preferred Date</label>
          <input type="date" name="booking_date" id="booking_date" min="{{ now()->toDateString() }}" value="{{ old('booking_date') }}" required>
          <span class="field-error" id="dateError">Please select a valid date.</span>
        </div>
      </div>

      {{-- DYNAMIC SLOT PICKER --}}
      <div class="slot-section">
        <div class="slot-section-header">
          <label style="margin-bottom:0;">Available Time Slots</label>
          <span id="slotHint">Select a date to see available slots</span>
        </div>

        {{-- Skeleton (hidden by default) --}}
        <div id="slotSkeleton" class="slot-skeleton" style="display:none;">
          @for($i=0;$i<8;$i++)
            <div class="slot-skeleton-item"></div>
          @endfor
        </div>

        {{-- Slot grid (populated by JS) --}}
        <div id="slotsGrid" class="slots-grid"></div>

        {{-- No slot / not available message --}}
        <div id="noSlotsMsg" class="no-slots-msg" style="display:none;">
          <i class="ri-calendar-close-line"></i>
          <span id="noSlotsMsgText">No slots available for this date.</span>
        </div>

        <span class="field-error" id="timeError" style="margin-top:0.4rem;">Please select a time slot.</span>
      </div>

      <div class="form-group">
        <label for="fee">Consultation Fee</label>
        <input type="text" name="fee" id="fee" value="{{ $therapist->fee }}" readonly>
      </div>

      <div class="form-group">
        <label for="message">Message <span style="font-weight:400; text-transform:none; letter-spacing:0; color:#9ca3af;">(optional)</span></label>
        <textarea name="message" id="message" placeholder="Share anything that would help the therapist prepare…">{{ old('message') }}</textarea>
        <div class="char-count"><span id="charCount">0</span>/500 characters</div>
        <span class="field-error" id="messageError">Message cannot exceed 500 characters.</span>
      </div>

      <button type="submit" id="submitBtn" class="submit-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 6l4-4 4 4M12 2v13"/><path d="M20 21H4a2 2 0 0 1-2-2v-1"/></svg>
        Confirm Booking
      </button>
    </form>
  </div>

  {{-- Sidebar --}}
  <div class="info-card">
    <div class="therapist-mini">
      <img src="{{ asset('images/therapists/' . $therapist->photopath) }}" alt="{{ $therapist->name }}">
      <div>
        <div class="therapist-mini-name">{{ $therapist->name }}</div>
        <div class="therapist-mini-spec">{{ $therapist->specialist->name ?? 'Therapist' }}</div>
      </div>
    </div>

    <div class="info-row">
      <div class="info-row-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
      <div>
        <div class="info-row-label">Location</div>
        <div class="info-row-val">{{ $therapist->location }}</div>
      </div>
    </div>

    {{-- Working Days --}}
    <div class="info-row" style="flex-direction:column; align-items:flex-start;">
      <div class="info-row-label" style="margin-bottom:0.5rem;">Working Schedule</div>
      <div class="schedule-info-wrap" style="width:100%;">
        @forelse($therapist->schedules as $sch)
          <div class="schedule-day-badge">
            <i class="ri-calendar-check-line"></i>
            <span>{{ $sch->day_of_week }}</span>
            <span style="margin-left:auto; font-size:0.72rem; color:#166534; font-weight:500;">
              {{ \Carbon\Carbon::parse($sch->start_time)->format('h:i A') }} – {{ \Carbon\Carbon::parse($sch->end_time)->format('h:i A') }}
            </span>
          </div>
        @empty
          <span style="font-size:0.82rem; color:#9ca3af;">No schedule set</span>
        @endforelse
      </div>
    </div>

    <div class="fee-highlight">
      <div class="fee-label">Consultation Fee</div>
      <div class="amount">Rs. {{ $therapist->fee }}</div>
    </div>
  </div>

</div>

<script>
(function(){
  const THERAPIST_ID = {{ $therapist->id }};
  const SLOTS_URL    = "{{ route('bookings.slots') }}";
  const OLD_TIME     = "{{ old('booking_time') }}";

  // ── DOM refs ──────────────────────────────────────────────────────────────
  const dateInput   = document.getElementById('booking_date');
  const hiddenTime  = document.getElementById('booking_time');
  const slotsGrid   = document.getElementById('slotsGrid');
  const skeleton    = document.getElementById('slotSkeleton');
  const noSlotsMsg  = document.getElementById('noSlotsMsg');
  const noSlotsTxt  = document.getElementById('noSlotsMsgText');
  const slotHint    = document.getElementById('slotHint');
  const timeError   = document.getElementById('timeError');

  let currentSelectedTime = OLD_TIME || '';

  // ── Char counter ──────────────────────────────────────────────────────────
  const msg = document.getElementById('message');
  const counter = document.getElementById('charCount');
  if (msg) {
    msg.addEventListener('input', () => {
      counter.textContent = msg.value.length;
      counter.style.color = msg.value.length > 500 ? '#ef4444' : '';
    });
  }

  // ── Validation helpers ────────────────────────────────────────────────────
  const show = (id, txt) => {
    const el  = document.getElementById(id);
    const inp = document.getElementById(id.replace('Error',''));
    if (txt) { el.textContent = txt; el.classList.add('show'); if (inp) inp.classList.add('error'); }
    else      { el.classList.remove('show'); if (inp) inp.classList.remove('error'); }
  };

  document.getElementById('name').addEventListener('blur', function(){
    show('nameError', this.value.trim() === '' ? 'Name is required.' : this.value.trim().length < 2 ? 'Min 2 characters.' : '');
  });
  document.getElementById('email').addEventListener('blur', function(){
    show('emailError', !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value.trim()) ? 'Enter a valid email address.' : '');
  });
  document.getElementById('phone').addEventListener('blur', function(){
    show('phoneError', !/^[0-9]{10}$/.test(this.value.trim()) ? 'Enter a valid 10-digit phone number.' : '');
  });
  document.getElementById('message').addEventListener('input', function(){
    show('messageError', this.value.length > 500 ? 'Message cannot exceed 500 characters.' : '');
  });

  // Clear errors on input
  ['name','email','phone','booking_date','message'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('input', () => show(id+'Error', ''));
  });

  // ── SLOT FETCHER ─────────────────────────────────────────────────────────
  dateInput.addEventListener('change', function(){
    const today = new Date().toISOString().split('T')[0];
    if (!this.value || this.value < today) {
      show('dateError', 'Please select a valid future date.');
      clearSlots();
      return;
    }
    show('dateError', '');
    fetchSlots(this.value);
  });

  function clearSlots() {
    slotsGrid.innerHTML   = '';
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

  function hideSkeleton() {
    skeleton.style.display = 'none';
  }

  function fetchSlots(date) {
    showSkeleton();

    const url = SLOTS_URL + '?therapist_id=' + THERAPIST_ID + '&date=' + date;

    fetch(url, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
      }
    })
    .then(res => res.json())
    .then(data => {
      hideSkeleton();

      if (!data.slots || data.slots.length === 0) {
        slotsGrid.innerHTML      = '';
        noSlotsTxt.textContent   = data.message || 'No available slots for this date.';
        noSlotsMsg.style.display = 'block';
        slotHint.textContent     = '';
        hiddenTime.value         = '';
        currentSelectedTime      = '';
        return;
      }

      noSlotsMsg.style.display = 'none';
      const available = data.slots.filter(s => s.available).length;
      slotHint.textContent = available + ' slot' + (available === 1 ? '' : 's') + ' available on ' + data.day;

      renderSlots(data.slots);
    })
    .catch(() => {
      hideSkeleton();
      noSlotsTxt.textContent   = 'Failed to load slots. Please try again.';
      noSlotsMsg.style.display = 'block';
      slotHint.textContent     = '';
    });
  }

  function renderSlots(slots) {
    slotsGrid.innerHTML = '';

    slots.forEach(slot => {
      const btn = document.createElement('button');
      btn.type        = 'button';
      btn.dataset.time = slot.time;
      btn.textContent  = slot.label;
      btn.className    = 'slot-btn';

      if (!slot.available) {
        btn.classList.add(slot.reason === 'past' ? 'past' : 'taken');
        btn.disabled = true;
      } else {
        // Restore old selection after validation error redirect
        if (slot.time === OLD_TIME || slot.time === currentSelectedTime) {
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
    // Deselect all
    slotsGrid.querySelectorAll('.slot-btn.selected').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    hiddenTime.value    = time;
    currentSelectedTime = time;
  }

  // ── Form submit ───────────────────────────────────────────────────────────
  document.getElementById('bookingForm').addEventListener('submit', function(e){
    let valid = true;
    const today = new Date().toISOString().split('T')[0];

    const name = document.getElementById('name').value.trim();
    if (!name || name.length < 2) { show('nameError', name ? 'Min 2 characters.' : 'Name is required.'); valid=false; }

    const email = document.getElementById('email').value.trim();
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { show('emailError', 'Enter a valid email address.'); valid=false; }

    const phone = document.getElementById('phone').value.trim();
    if (!/^[0-9]{10}$/.test(phone)) { show('phoneError', 'Enter a valid 10-digit phone number.'); valid=false; }

    const date = document.getElementById('booking_date').value;
    if (!date || date < today) { show('dateError', date ? 'Please select a future date.' : 'Please select a date.'); valid=false; }

    if (!hiddenTime.value) { show('timeError', 'Please select a time slot.'); valid=false; }

    const message = document.getElementById('message').value;
    if (message.length > 500) { show('messageError', 'Message cannot exceed 500 characters.'); valid=false; }

    if (!valid) {
      e.preventDefault();
      const firstError = document.querySelector('.field-error.show');
      if (firstError) firstError.scrollIntoView({ behavior:'smooth', block:'center' });
    } else {
      const btn = document.getElementById('submitBtn');
      btn.disabled = true;
      btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin"><path d="M21 12a9 9 0 1 1-9-9"/></svg> Booking…';
    }
  });

  // ── Auto-load slots if old date present (after validation error) ──────────
  if (dateInput.value) {
    fetchSlots(dateInput.value);
  }
})();
</script>

<style>
  @keyframes spin { to { transform:rotate(360deg); } }
  .spin { animation:spin 0.8s linear infinite; }
</style>
@endsection