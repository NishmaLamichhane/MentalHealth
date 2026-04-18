<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peaceful Mind — Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root { --teal:#0f7c7c; --teal-light:#e6f4f4; --teal-mid:#1a9e9e; --navy:#0d2d45; --gold:#c9974a; --soft-white:#fafaf8; }
    body { font-family:'DM Sans',sans-serif; background:var(--soft-white); min-height:100vh; display:flex; }

    .auth-container { display:grid; grid-template-columns:1fr 1fr; min-height:100vh; width:100%; }

    /* Left panel */
    .auth-visual {
      background:linear-gradient(135deg, var(--navy) 0%, #174a6e 40%, var(--teal) 100%);
      display:flex; flex-direction:column; align-items:center; justify-content:center;
      padding:3rem; text-align:center; position:relative; overflow:hidden;
    }
    .auth-visual::before {
      content:''; position:absolute; inset:0;
      background:radial-gradient(ellipse at 30% 70%, rgba(201,151,74,0.2) 0%, transparent 60%);
      pointer-events:none;
    }
    .auth-visual img { width:100%; max-width:340px; height:320px; object-fit:cover; border-radius:24px; box-shadow:0 20px 50px rgba(0,0,0,0.3); margin-bottom:2rem; position:relative; z-index:1; }
    .auth-visual-title { font-family:'Playfair Display',serif; font-size:1.8rem; color:#fff; line-height:1.3; position:relative; z-index:1; }
    .auth-visual-sub { color:rgba(255,255,255,0.65); font-size:0.88rem; margin-top:0.6rem; line-height:1.7; position:relative; z-index:1; }
    .auth-dots { display:flex; gap:0.5rem; margin-top:1.5rem; position:relative; z-index:1; }
    .auth-dots span { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.3); }
    .auth-dots span:first-child { background:#fff; width:24px; border-radius:4px; }

    /* Right panel */
    .auth-form-panel { display:flex; align-items:center; justify-content:center; padding:2.5rem 1.5rem; background:#fff; overflow-y:auto; }
    .auth-form-inner { width:100%; max-width:400px; }
    .auth-brand { display:flex; align-items:center; gap:0.6rem; margin-bottom:2rem; }
    .auth-brand-dot { width:10px; height:10px; background:var(--teal); border-radius:50%; }
    .auth-brand-name { font-family:'Playfair Display',serif; font-size:1.1rem; color:var(--navy); }
    .auth-brand-name span { color:var(--gold); }

    .auth-title { font-family:'Playfair Display',serif; font-size:2rem; color:var(--navy); margin-bottom:0.4rem; }
    .auth-subtitle { color:#9ca3af; font-size:0.88rem; margin-bottom:2rem; }

    .form-group { margin-bottom:1.1rem; }
    label { display:block; font-size:0.72rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:#374151; margin-bottom:0.45rem; }
    input[type=text], input[type=email], input[type=password] {
      width:100%; padding:0.8rem 1rem; border:1.5px solid #e5e7eb;
      border-radius:12px; font-size:0.9rem; font-family:'DM Sans',sans-serif; color:#1f2937;
      background:var(--soft-white); outline:none; transition:border-color 0.2s, box-shadow 0.2s;
    }
    input:focus { border-color:var(--teal); box-shadow:0 0 0 3px rgba(15,124,124,0.12); background:#fff; }
    .field-error { color:#ef4444; font-size:0.75rem; margin-top:0.3rem; display:block; min-height:1em; }

    .submit-btn { width:100%; background:linear-gradient(135deg,var(--teal-mid),var(--teal)); color:#fff; padding:0.9rem; border:none; border-radius:12px; font-size:1rem; font-weight:700; font-family:'DM Sans',sans-serif; cursor:pointer; box-shadow:0 6px 20px rgba(15,124,124,0.35); transition:transform 0.2s, box-shadow 0.2s; margin-top:0.75rem; }
    .submit-btn:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(15,124,124,0.45); }

    .auth-footer { text-align:center; margin-top:1.25rem; font-size:0.85rem; color:#9ca3af; }
    .auth-footer a { color:var(--teal); font-weight:600; text-decoration:none; }
    .auth-footer a:hover { text-decoration:underline; }

    .back-home { display:flex; align-items:center; justify-content:center; gap:0.4rem; margin-top:0.75rem; color:#9ca3af; font-size:0.83rem; text-decoration:none; transition:color 0.2s; }
    .back-home:hover { color:var(--navy); }

    @media(max-width:768px){
      .auth-container { grid-template-columns:1fr; }
      .auth-visual { display:none; }
      .auth-form-panel { padding:2rem 1.25rem; min-height:100vh; }
      .auth-title { font-size:1.7rem; }
    }
  </style>
</head>
<body>
<div class="auth-container">

  {{-- Left Visual --}}
  <div class="auth-visual">
    <img src="{{ asset('image/Naruto.png') }}" alt="Register Illustration">
    <div class="auth-visual-title">Begin Your Healing<br>Journey Today</div>
    <div class="auth-visual-sub">Join thousands finding peace and balance<br>with expert therapists and mindfulness tools.</div>
    <div class="auth-dots"><span></span><span></span><span></span></div>
  </div>

  {{-- Right Form --}}
  <div class="auth-form-panel">
    <div class="auth-form-inner">
      <div class="auth-brand">
        <div class="auth-brand-dot"></div>
        <div class="auth-brand-name">Peaceful <span>Mind</span></div>
      </div>
      <h1 class="auth-title">Create Account</h1>
      <p class="auth-subtitle">Start your mental wellness journey — it's free.</p>

      <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm(event)">
        @csrf

        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your name" required autofocus autocomplete="name">
          <span id="nameError" class="field-error"></span>
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="username">
          <span id="emailError" class="field-error"></span>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="At least 6 characters" required autocomplete="new-password">
          <span id="passwordError" class="field-error"></span>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat your password" required autocomplete="new-password">
          <span id="confirmPasswordError" class="field-error"></span>
        </div>

        <button type="submit" class="submit-btn">Create Account →</button>
      </form>

      <div class="auth-footer">
        Already have an account? <a href="{{ route('login') }}">Sign In</a>
      </div>
      <a href="{{ route('home') }}" class="back-home">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Back to Home
      </a>
    </div>
  </div>
</div>

<script>
  function validateForm(event) {
    let isValid = true;
    const show = (id, msg) => { document.getElementById(id).innerText = msg; if(msg) isValid = false; };

    const name = document.getElementById('name').value.trim();
    show('nameError', name.length < 3 ? 'Name must be at least 3 characters.' : '');

    const email = document.getElementById('email').value.trim();
    show('emailError', !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) ? 'Enter a valid email address.' : '');

    const pw = document.getElementById('password').value;
    show('passwordError', pw.length < 6 ? 'Password must be at least 6 characters.' : '');

    const cpw = document.getElementById('password_confirmation').value;
    show('confirmPasswordError', cpw !== pw ? 'Passwords do not match.' : '');

    if (!isValid) event.preventDefault();
    return isValid;
  }
  ['name','email','password','password_confirmation'].forEach(id => {
    document.getElementById(id).addEventListener('input', () => {
      const errId = id === 'password_confirmation' ? 'confirmPasswordError' : id + 'Error';
      document.getElementById(errId).innerText = '';
    });
  });
</script>
</body>
</html>