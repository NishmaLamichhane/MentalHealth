@extends('layouts.master')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
  *, *::before, *::after { box-sizing:border-box; }
  :root { --teal:#0f7c7c; --teal-light:#e6f4f4; --teal-mid:#1a9e9e; --navy:#0d2d45; --gold:#c9974a; --soft-white:#fafaf8; }
  body { font-family:'DM Sans',sans-serif; background:var(--soft-white); }

  .booking-hero {
    background:linear-gradient(135deg, var(--navy) 0%, #174a6e 50%, #0f5a5a 100%);
    padding:2.5rem 1.5rem; text-align:center; position:relative; overflow:hidden;
  }
  .booking-hero::before {
    content:''; position:absolute; inset:0;
    background:radial-gradient(ellipse at 70% 50%, rgba(26,158,158,0.2) 0%, transparent 60%);
    pointer-events:none;
  }
  .booking-hero h1 { font-family:'Playfair Display',serif; font-size:clamp(1.5rem,4vw,2.4rem); color:#fff; margin-bottom:0.4rem; position:relative; z-index:1; }
  .booking-hero p { color:rgba(255,255,255,0.65); font-size:0.9rem; position:relative; z-index:1; }

  .booking-layout { max-width:860px; margin:2.5rem auto 4rem; padding:0 1.25rem; display:grid; grid-template-columns:1fr 300px; gap:2rem; align-items:start; }

  /* Form card */
  .form-card { background:#fff; border-radius:24px; padding:2.25rem; box-shadow:0 6px 30px rgba(13,45,69,0.09); border:1px solid rgba(13,45,69,0.07); }
  .form-card h2 { font-family:'Playfair Display',serif; font-size:1.3rem; color:var(--navy); margin-bottom:1.75rem; padding-bottom:1rem; border-bottom:1px solid #f0f0ee; }
  .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }

  .form-group { margin-bottom:1.15rem; }
  label { display:block; font-size:0.72rem; font-weight:700; letter-spacing:0.09em; text-transform:uppercase; color:#374151; margin-bottom:0.45rem; }
  input[type=text], input[type=email], input[type=date], select, textarea {
    width:100%; padding:0.78rem 1rem; border:1.5px solid #e5e7eb;
    border-radius:11px; font-size:0.88rem; font-family:'DM Sans',sans-serif; color:#1f2937;
    background:var(--soft-white); outline:none; transition:border-color 0.2s, box-shadow 0.2s;
  }
  input:focus, select:focus, textarea:focus { border-color:var(--teal); box-shadow:0 0 0 3px rgba(15,124,124,0.12); background:#fff; }
  input.error, select.error, textarea.error { border-color:#ef4444; box-shadow:0 0 0 3px rgba(239,68,68,0.1); }
  .field-error { color:#ef4444; font-size:0.75rem; margin-top:0.3rem; display:none; align-items:center; gap:0.3rem; }
  .field-error.show { display:flex; }
  textarea { resize:vertical; min-height:100px; }
  input[readonly] { background:#f3f4f6; color:#6b7280; cursor:default; }

  .char-count { font-size:0.72rem; color:#9ca3af; text-align:right; margin-top:0.25rem; }

  .submit-btn { width:100%; background:linear-gradient(135deg,var(--teal-mid),var(--teal)); color:#fff; padding:1rem; border:none; border-radius:12px; font-size:1rem; font-weight:700; font-family:'DM Sans',sans-serif; cursor:pointer; box-shadow:0 6px 20px rgba(15,124,124,0.35); transition:transform 0.2s, box-shadow 0.2s; margin-top:0.5rem; display:flex; align-items:center; justify-content:center; gap:0.5rem; }
  .submit-btn:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(15,124,124,0.45); }
  .submit-btn:disabled { opacity:0.6; cursor:not-allowed; transform:none; }

  /* Sidebar info card */
  .info-card { background:#fff; border-radius:24px; padding:1.75rem; box-shadow:0 6px 30px rgba(13,45,69,0.09); border:1px solid rgba(13,45,69,0.07); position:sticky; top:2rem; }
  .therapist-mini { display:flex; align-items:center; gap:0.9rem; margin-bottom:1.5rem; padding-bottom:1.25rem; border-bottom:1px solid #f0f0ee; }
  .therapist-mini img { width:56px; height:56px; border-radius:14px; object-fit:cover; }
  .therapist-mini-name { font-family:'Playfair Display',serif; font-size:1rem; color:var(--navy); }
  .therapist-mini-spec { font-size:0.78rem; color:var(--teal); font-weight:600; }
  .info-row { display:flex; gap:0.6rem; margin-bottom:1rem; }
  .info-row-icon { width:32px; height:32px; background:var(--teal-light); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
  .info-row-icon svg { width:15px; height:15px; color:var(--teal); }
  .info-row-label { font-size:0.72rem; color:#9ca3af; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; }
  .info-row-val { font-size:0.88rem; color:var(--navy); font-weight:600; }
  .fee-highlight { background:var(--teal-light); border-radius:10px; padding:0.8rem 1rem; text-align:center; margin-top:1rem; }
  .fee-highlight .amount { font-family:'Playfair Display',serif; font-size:1.5rem; color:var(--teal); }
  .fee-highlight .fee-label { font-size:0.72rem; color:#4b7a7a; text-transform:uppercase; letter-spacing:0.1em; }

  /* Server-side errors */
  .alert-errors { background:#fef2f2; border:1px solid #fecaca; border-radius:12px; padding:1rem 1.25rem; margin-bottom:1.5rem; }
  .alert-errors p { color:#991b1b; font-size:0.83rem; font-weight:600; margin-bottom:0.35rem; }
  .alert-errors ul { list-style:none; }
  .alert-errors li { color:#b91c1c; font-size:0.8rem; padding:0.15rem 0; display:flex; align-items:center; gap:0.4rem; }

  @media(max-width:768px){
    .booking-layout { grid-template-columns:1fr; }
    .info-card { position:static; }
    .form-row { grid-template-columns:1fr; gap:0; }
  }
  @media(max-width:480px){
    .form-card { padding:1.5rem 1.25rem; }
    .booking-hero { padding:2rem 1rem; }
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

      <div class="form-row">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name" placeholder="Your full name" value="{{ old('name') }}" required>
          <span class="field-error" id="nameError">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Name is required.
          </span>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" name="email" id="email" placeholder="you@example.com" value="{{ old('email') }}" required>
          <span class="field-error" id="emailError">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Enter a valid email address.
          </span>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="text" name="phone" id="phone" placeholder="10-digit number" value="{{ old('phone') }}" required>
          <span class="field-error" id="phoneError">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Enter a valid 10-digit phone number.
          </span>
        </div>
        <div class="form-group">
          <label for="booking_date">Preferred Date</label>
          <input type="date" name="booking_date" id="booking_date" min="{{ now()->toDateString() }}" value="{{ old('booking_date') }}" required>
          <span class="field-error" id="dateError">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Please select a valid date.
          </span>
        </div>
      </div>

      <div class="form-group">
        <label for="booking_time">Time Slot</label>
        <select name="booking_time" id="booking_time" required>
          <option value="">— Select a time —</option>
          @foreach(['09:00'=>'09:00 AM','10:00'=>'10:00 AM','11:00'=>'11:00 AM','12:00'=>'12:00 PM','13:00'=>'01:00 PM','14:00'=>'02:00 PM','15:00'=>'03:00 PM','16:00'=>'04:00 PM','17:00'=>'05:00 PM'] as $val => $label)
          <option value="{{ $val }}" {{ old('booking_time') == $val ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
        <span class="field-error" id="timeError">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          Please select a time slot.
        </span>
      </div>

      <div class="form-group">
        <label for="fee">Consultation Fee</label>
        <input type="text" name="fee" id="fee" value="{{ $therapist->fee }}" readonly>
      </div>

      <div class="form-group">
        <label for="message">Message <span style="font-weight:400; text-transform:none; letter-spacing:0; color:#9ca3af;">(optional)</span></label>
        <textarea name="message" id="message" placeholder="Share anything that would help the therapist prepare for your session…">{{ old('message') }}</textarea>
        <div class="char-count"><span id="charCount">0</span>/500 characters</div>
        <span class="field-error" id="messageError">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          Message cannot exceed 500 characters.
        </span>
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
        <div class="therapist-mini-spec">{{ $therapist->specialization ?? 'Therapist' }}</div>
      </div>
    </div>

    <div class="info-row">
      <div class="info-row-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
      <div>
        <div class="info-row-label">Location</div>
        <div class="info-row-val">{{ $therapist->location }}</div>
      </div>
    </div>

    <div class="info-row">
      <div class="info-row-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
      <div>
        <div class="info-row-label">Session Hours</div>
        <div class="info-row-val">9 AM – 5 PM</div>
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
  // Character counter
  const msg = document.getElementById('message');
  const counter = document.getElementById('charCount');
  if(msg) {
    msg.addEventListener('input', () => {
      counter.textContent = msg.value.length;
      if(msg.value.length > 500) { counter.style.color='#ef4444'; } else { counter.style.color=''; }
    });
  }

  const show = (id, txt) => {
    const el = document.getElementById(id);
    const inp = document.getElementById(id.replace('Error',''));
    if(txt) { el.textContent = txt; el.classList.add('show'); if(inp) inp.classList.add('error'); }
    else { el.classList.remove('show'); if(inp) inp.classList.remove('error'); }
  };

  // Live validation on blur
  document.getElementById('name').addEventListener('blur', function(){
    show('nameError', this.value.trim() === '' ? 'Name is required.' : this.value.trim().length < 2 ? 'Name must be at least 2 characters.' : '');
  });
  document.getElementById('email').addEventListener('blur', function(){
    show('emailError', !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value.trim()) ? 'Enter a valid email address.' : '');
  });
  document.getElementById('phone').addEventListener('blur', function(){
    show('phoneError', !/^[0-9]{10}$/.test(this.value.trim()) ? 'Enter a valid 10-digit phone number.' : '');
  });
  document.getElementById('booking_date').addEventListener('change', function(){
    const today = new Date().toISOString().split('T')[0];
    show('dateError', this.value === '' ? 'Please select a date.' : this.value < today ? 'Please select a future date.' : '');
  });
  document.getElementById('booking_time').addEventListener('change', function(){
    show('timeError', this.value === '' ? 'Please select a time slot.' : '');
  });
  document.getElementById('message').addEventListener('input', function(){
    show('messageError', this.value.length > 500 ? 'Message cannot exceed 500 characters.' : '');
  });

  // Clear errors on input
  ['name','email','phone','booking_date','booking_time','message'].forEach(id => {
    const el = document.getElementById(id);
    if(el) el.addEventListener('input', () => show(id+'Error', ''));
  });

  // Form submit validation
  document.getElementById('bookingForm').addEventListener('submit', function(e){
    let valid = true;
    const today = new Date().toISOString().split('T')[0];

    const name = document.getElementById('name').value.trim();
    const nameMsg = name === '' ? 'Name is required.' : name.length < 2 ? 'Name must be at least 2 characters.' : '';
    if(nameMsg){ show('nameError', nameMsg); valid=false; }

    const email = document.getElementById('email').value.trim();
    if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){ show('emailError', 'Enter a valid email address.'); valid=false; }

    const phone = document.getElementById('phone').value.trim();
    if(!/^[0-9]{10}$/.test(phone)){ show('phoneError', 'Enter a valid 10-digit phone number.'); valid=false; }

    const date = document.getElementById('booking_date').value;
    if(date === ''){ show('dateError', 'Please select a date.'); valid=false; }
    else if(date < today){ show('dateError', 'Please select a future date.'); valid=false; }

    const time = document.getElementById('booking_time').value;
    if(time === ''){ show('timeError', 'Please select a time slot.'); valid=false; }

    const message = document.getElementById('message').value;
    if(message.length > 500){ show('messageError', 'Message cannot exceed 500 characters.'); valid=false; }

    if(!valid){
      e.preventDefault();
      // Scroll to first error
      const firstError = document.querySelector('.field-error.show');
      if(firstError) firstError.scrollIntoView({behavior:'smooth', block:'center'});
    } else {
      const btn = document.getElementById('submitBtn');
      btn.disabled = true;
      btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin"><path d="M21 12a9 9 0 1 1-9-9"/></svg> Booking...';
    }
  });
})();
</script>

<style>
  @keyframes spin { to { transform:rotate(360deg); } }
  .spin { animation:spin 0.8s linear infinite; }
</style>
@endsection