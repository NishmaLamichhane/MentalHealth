<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In — Peaceful Mind</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --sky: #dbeeff;
      --sky-mid: #b3d9f7;
      --sky-deep: #5ba8e0;
      --sky-text: #1a4a72;
      --teal: #3a9eb5;
      --teal-light: #e5f5fa;
      --cream: #f7fbff;
      --slate: #2d4a62;
      --muted: #7a9ab8;
      --white: #ffffff;
      --border: rgba(91,168,224,0.22);
    }

    html, body {
      height: 100%;
      font-family: 'Outfit', sans-serif;
      background: var(--cream);
    }

    /* ───────────────────────────
       WRAPPER
    ─────────────────────────── */
    .wrapper {
      display: flex;
      min-height: 100vh;
    }

    /* ───────────────────────────
       LEFT PANEL
    ─────────────────────────── */
    .left-panel {
      width: 48%;
      background: linear-gradient(160deg, #c8e8f8 0%, #a8d8f0 35%, #7dc3ea 70%, #5ba8e0 100%);
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 3rem 2.5rem;
    }

    .left-panel::before {
      content: '';
      position: absolute;
      top: -120px; right: -120px;
      width: 380px; height: 380px;
      background: rgba(255,255,255,0.18);
      border-radius: 50%;
      pointer-events: none;
    }

    .left-panel::after {
      content: '';
      position: absolute;
      bottom: -80px; left: -80px;
      width: 260px; height: 260px;
      background: rgba(255,255,255,0.12);
      border-radius: 50%;
      pointer-events: none;
    }

    .left-content {
      position: relative;
      z-index: 2;
      text-align: center;
    }

    .illo-wrap {
      margin-bottom: 2rem;
    }

    /* floating animation on illustration */
    .illo-wrap svg {
      animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50%       { transform: translateY(-10px); }
    }

    .left-tagline {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.1rem;
      font-weight: 600;
      color: var(--sky-text);
      line-height: 1.25;
      margin-bottom: 1rem;
      letter-spacing: -0.01em;
    }

    .left-desc {
      font-size: 0.875rem;
      color: rgba(26, 74, 114, 0.72);
      line-height: 1.7;
      max-width: 300px;
      font-weight: 300;
      margin: 0 auto;
    }

    .feature-pills {
      display: flex;
      flex-direction: column;
      gap: 0.65rem;
      margin-top: 2rem;
      align-items: flex-start;
    }

    .pill {
      display: flex;
      align-items: center;
      gap: 0.55rem;
      background: rgba(255,255,255,0.42);
      border: 0.5px solid rgba(255,255,255,0.6);
      border-radius: 100px;
      padding: 0.45rem 1rem;
      font-size: 0.8rem;
      font-weight: 500;
      color: var(--sky-text);
      backdrop-filter: blur(4px);
      transition: background 0.2s;
    }

    .pill:hover {
      background: rgba(255,255,255,0.6);
    }

    .pill-dot {
      width: 8px; height: 8px;
      background: var(--teal);
      border-radius: 50%;
      flex-shrink: 0;
    }

    /* ───────────────────────────
       RIGHT PANEL
    ─────────────────────────── */
    .right-panel {
      width: 52%;
      background: var(--white);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 3rem 3rem 3rem 3.5rem;
    }

    .form-container {
      width: 100%;
      max-width: 390px;
      animation: fadeUp 0.5s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(18px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Brand */
    .brand {
      display: flex;
      align-items: center;
      gap: 0.55rem;
      margin-bottom: 2.5rem;
    }

    .brand-icon {
      width: 34px; height: 34px;
      background: linear-gradient(135deg, var(--teal), var(--sky-deep));
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }

    .brand-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.15rem;
      font-weight: 600;
      color: var(--slate);
      letter-spacing: 0.01em;
    }

    .brand-name em {
      color: var(--teal);
      font-style: normal;
    }

    /* Headings */
    .form-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      font-weight: 600;
      color: var(--slate);
      margin-bottom: 0.3rem;
      line-height: 1.2;
    }

    .form-sub {
      font-size: 0.83rem;
      color: var(--muted);
      font-weight: 300;
      margin-bottom: 2rem;
    }

    /* Fields */
    .field {
      margin-bottom: 1.1rem;
    }

    .field label {
      display: block;
      font-size: 0.7rem;
      font-weight: 600;
      letter-spacing: 0.09em;
      text-transform: uppercase;
      color: var(--slate);
      margin-bottom: 0.4rem;
    }

    .input-wrap {
      position: relative;
    }

    .input-wrap .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      opacity: 0.5;
      pointer-events: none;
      display: flex;
      align-items: center;
    }

    .field input[type="email"],
    .field input[type="password"] {
      width: 100%;
      padding: 0.8rem 1rem 0.8rem 2.8rem;
      border: 1.5px solid var(--border);
      border-radius: 12px;
      font-family: 'Outfit', sans-serif;
      font-size: 0.9rem;
      color: var(--slate);
      background: var(--teal-light);
      outline: none;
      transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }

    .field input[type="email"]:focus,
    .field input[type="password"]:focus {
      border-color: var(--sky-deep);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(91,168,224,0.15);
    }

    .field input::placeholder {
      color: var(--muted);
      opacity: 0.7;
    }

    /* Error messages */
    .field-error {
      display: block;
      margin-top: 0.3rem;
      font-size: 0.78rem;
      color: #e05252;
    }

    /* Remember / Forgot row */
    .extras-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.5rem;
      font-size: 0.82rem;
    }

    .check-label {
      display: flex;
      align-items: center;
      gap: 0.45rem;
      color: var(--slate);
      cursor: pointer;
      font-weight: 400;
    }

    .check-label input[type="checkbox"] {
      accent-color: var(--teal);
      width: 15px; height: 15px;
    }

    .forgot {
      color: var(--teal);
      font-weight: 600;
      text-decoration: none;
      transition: opacity 0.15s;
    }

    .forgot:hover { opacity: 0.75; text-decoration: underline; }

    /* Submit button */
    .submit-btn {
      width: 100%;
      padding: 0.9rem 1rem;
      background: linear-gradient(135deg, var(--teal) 0%, var(--sky-deep) 100%);
      color: #fff;
      border: none;
      border-radius: 12px;
      font-family: 'Outfit', sans-serif;
      font-size: 0.96rem;
      font-weight: 600;
      cursor: pointer;
      letter-spacing: 0.03em;
      transition: transform 0.18s, box-shadow 0.18s, opacity 0.18s;
      box-shadow: 0 6px 22px rgba(58,158,181,0.32);
    }

    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 28px rgba(58,158,181,0.44);
    }

    .submit-btn:active {
      transform: scale(0.98);
      opacity: 0.9;
    }

    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      margin: 1.35rem 0;
      font-size: 0.75rem;
      color: var(--muted);
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    /* Register row */
    .register-row {
      text-align: center;
      font-size: 0.84rem;
      color: var(--muted);
    }

    .register-row a {
      color: var(--teal);
      font-weight: 600;
      text-decoration: none;
    }

    .register-row a:hover { text-decoration: underline; }

    /* Trust badges */
    .trust-badges {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 1.25rem;
      margin-top: 1.5rem;
      padding-top: 1.25rem;
      border-top: 1px solid var(--border);
    }

    .trust-item {
      display: flex;
      align-items: center;
      gap: 0.32rem;
      font-size: 0.7rem;
      color: var(--muted);
    }

    /* ───────────────────────────
       RESPONSIVE
    ─────────────────────────── */
    @media (max-width: 768px) {
      .wrapper {
        flex-direction: column;
      }

      .left-panel {
        width: 100%;
        min-height: 280px;
        padding: 2.5rem 1.5rem;
      }

      .left-tagline { font-size: 1.65rem; }

      .feature-pills {
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
      }

      .right-panel {
        width: 100%;
        padding: 2.5rem 1.5rem;
      }
    }

    @media (max-width: 480px) {
      .left-panel { min-height: 240px; }
      .form-title { font-size: 1.7rem; }
      .trust-badges { flex-wrap: wrap; gap: 0.75rem; }
    }
  </style>
</head>
<body>

<div class="wrapper">

  <!-- ══════════════════════════
       LEFT — Illustration Panel
  ═══════════════════════════ -->
  <div class="left-panel">
    <div class="left-content">

      <!-- SVG Illustration -->
      <div class="illo-wrap">
        <svg width="220" height="200" viewBox="0 0 220 200" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <!-- Background glow circle -->
          <circle cx="110" cy="100" r="90" fill="rgba(255,255,255,0.22)" />

          <!-- Calm water / ground -->
          <ellipse cx="110" cy="162" rx="72" ry="14" fill="rgba(255,255,255,0.28)" />

          <!-- Seated meditating figure -->
          <!-- Body -->
          <ellipse cx="110" cy="138" rx="18" ry="24" fill="rgba(255,255,255,0.55)" />
          <!-- Head -->
          <circle cx="110" cy="106" r="16" fill="rgba(255,255,255,0.65)" />
          <!-- Hair -->
          <path d="M94 103 Q95 91 110 89 Q125 91 126 103" fill="rgba(90,160,220,0.55)" />
          <!-- Left arm -->
          <path d="M92 130 Q85 142 90 150" stroke="rgba(255,255,255,0.7)" stroke-width="4" stroke-linecap="round" fill="none"/>
          <!-- Right arm -->
          <path d="M128 130 Q135 142 130 150" stroke="rgba(255,255,255,0.7)" stroke-width="4" stroke-linecap="round" fill="none"/>
          <!-- Crossed legs -->
          <ellipse cx="95"  cy="158" rx="10" ry="6" fill="rgba(255,255,255,0.45)" />
          <ellipse cx="125" cy="158" rx="10" ry="6" fill="rgba(255,255,255,0.45)" />
          <!-- Hands -->
          <circle cx="90"  cy="151" r="4" fill="rgba(255,255,255,0.6)" />
          <circle cx="130" cy="151" r="4" fill="rgba(255,255,255,0.6)" />
          <!-- Closed eyes -->
          <path d="M104 107 Q107 109 110 107" stroke="rgba(58,130,190,0.7)" stroke-width="1.5" stroke-linecap="round" fill="none"/>
          <path d="M110 107 Q113 109 116 107" stroke="rgba(58,130,190,0.7)" stroke-width="1.5" stroke-linecap="round" fill="none"/>
          <!-- Smile -->
          <path d="M105 112 Q110 117 115 112" stroke="rgba(58,130,190,0.6)" stroke-width="1.5" stroke-linecap="round" fill="none"/>

          <!-- Breath/floating bubbles left -->
          <circle cx="72" cy="80" r="5"   fill="rgba(255,255,255,0.40)" />
          <circle cx="62" cy="62" r="3.5" fill="rgba(255,255,255,0.30)" />
          <circle cx="55" cy="48" r="2.5" fill="rgba(255,255,255,0.20)" />

          <!-- Breath/floating bubbles right -->
          <circle cx="150" cy="74" r="6"   fill="rgba(255,255,255,0.38)" />
          <circle cx="162" cy="56" r="4"   fill="rgba(255,255,255,0.28)" />
          <circle cx="170" cy="41" r="2.5" fill="rgba(255,255,255,0.18)" />

          <!-- Sparkle / star top-left -->
          <path d="M80 38 L81.5 34 L83 38 L87 39.5 L83 41 L81.5 45 L80 41 L76 39.5 Z" fill="rgba(255,255,255,0.75)"/>
          <!-- Sparkle top-right -->
          <path d="M138 28 L139 25 L140 28 L143 29 L140 30 L139 33 L138 30 L135 29 Z" fill="rgba(255,255,255,0.65)"/>
          <!-- Sparkle mid-right -->
          <path d="M162 70 L162.8 68 L163.6 70 L165.6 70.8 L163.6 71.6 L162.8 73.6 L162 71.6 L160 70.8 Z" fill="rgba(255,255,255,0.55)"/>

          <!-- Small crescent moon -->
          <path d="M56 74 A14 14 0 1 1 70 74 A10 10 0 1 0 56 74 Z" fill="rgba(255,255,255,0.38)" />

          <!-- Wavy water reflections -->
          <path d="M78 170 Q95 166 110 170 Q125 174 142 170" stroke="rgba(255,255,255,0.38)" stroke-width="1.5" stroke-linecap="round" fill="none"/>
          <path d="M85 176 Q100 173 115 176 Q130 179 138 176" stroke="rgba(255,255,255,0.22)" stroke-width="1"   stroke-linecap="round" fill="none"/>
        </svg>
      </div>

      <h2 class="left-tagline">Find your calm.<br>Heal your mind.</h2>
      <p class="left-desc">A compassionate space for mental wellness, guided reflection, and daily peace.</p>

    

    </div>
  </div><!-- /left-panel -->


  <!-- ══════════════════════════
       RIGHT — Login Form
  ═══════════════════════════ -->
  <div class="right-panel">
    <div class="form-container">

      <!-- Brand -->
      <div class="brand">
        <div class="brand-icon" aria-hidden="true">
          <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path d="M9 2C6.8 2 4.5 3.5 4.5 6.5C4.5 9.5 7 11.5 9 14C11 11.5 13.5 9.5 13.5 6.5C13.5 3.5 11.2 2 9 2Z" fill="white" opacity="0.9"/>
            <circle cx="9" cy="6.5" r="2" fill="rgba(255,255,255,0.5)"/>
          </svg>
        </div>
        <span class="brand-name">Peaceful <em>Mind</em></span>
      </div>

      <h1 class="form-title">Welcome back</h1>
      <p class="form-sub">Sign in to continue your wellness journey.</p>

      <!-- ─── Laravel Form ─── -->
      <form action="{{ route('login') }}" method="POST" novalidate>
        @csrf

        <!-- Email -->
        <div class="field">
          <label for="email">Email address</label>
          <div class="input-wrap">
            <span class="input-icon" aria-hidden="true">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <rect x="1" y="3" width="14" height="10" rx="2" stroke="#5ba8e0" stroke-width="1.4"/>
                <path d="M1 5.5L8 9.5L15 5.5" stroke="#5ba8e0" stroke-width="1.4" stroke-linecap="round"/>
              </svg>
            </span>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="you@example.com"
              value="{{ old('email') }}"
              required
              autocomplete="email"
            />
          </div>
          @error('email')
            <span class="field-error" role="alert">{{ $message }}</span>
          @enderror
        </div>

        <!-- Password -->
        <div class="field">
          <label for="password">Password</label>
          <div class="input-wrap">
            <span class="input-icon" aria-hidden="true">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <rect x="3" y="7" width="10" height="7" rx="1.5" stroke="#5ba8e0" stroke-width="1.4"/>
                <path d="M5.5 7V5a2.5 2.5 0 015 0v2" stroke="#5ba8e0" stroke-width="1.4" stroke-linecap="round"/>
                <circle cx="8" cy="10.5" r="1" fill="#5ba8e0"/>
              </svg>
            </span>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter your password"
              required
              autocomplete="current-password"
            />
          </div>
          @error('password')
            <span class="field-error" role="alert">{{ $message }}</span>
          @enderror
        </div>

        <!-- Remember / Forgot -->
        <div class="extras-row">
          <label class="check-label" for="remember">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
            Remember me
          </label>
          @if (Route::has('password.request'))
            <a class="forgot" href="{{ route('password.request') }}">Forgot password?</a>
          @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="submit-btn">Sign In &rarr;</button>

      </form>
      <!-- ─── End Form ─── -->

      <div class="divider">or</div>

      <div class="register-row">
        Don't have an account?
        @if (Route::has('register'))
          <a href="{{ route('register') }}">Create one</a>
        @endif
      </div>

      <!-- Trust badges -->
      <div class="trust-badges" aria-label="Security and compliance badges">
        <div class="trust-item">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
            <path d="M6 1L7.5 4.5L11 5L8.5 7.5L9 11L6 9.5L3 11L3.5 7.5L1 5L4.5 4.5Z" fill="#3a9eb5" opacity="0.75"/>
          </svg>
          Trusted &amp; safe
        </div>
      </div>

    </div>
  </div><!-- /right-panel -->

</div><!-- /wrapper -->

</body>
</html>