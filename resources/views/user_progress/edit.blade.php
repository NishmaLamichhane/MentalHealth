@extends('layouts.master')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
  :root { --teal:#0f7c7c; --teal-light:#e6f4f4; --teal-mid:#1a9e9e; --navy:#0d2d45; --soft-white:#fafaf8; }
  body { font-family:'DM Sans',sans-serif; background:var(--soft-white); }

  .form-page { min-height:100vh; background:linear-gradient(135deg,#fff7ed 0%,var(--soft-white) 100%); display:flex; align-items:center; justify-content:center; padding:2.5rem 1.25rem; }
  .form-card { background:#fff; border-radius:24px; padding:2.5rem; box-shadow:0 8px 40px rgba(13,45,69,0.1); border:1px solid rgba(13,45,69,0.07); width:100%; max-width:520px; }
  .form-icon { width:52px; height:52px; background:#fff7ed; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-bottom:1.25rem; }
  .form-icon svg { width:26px; height:26px; color:#d97706; }
  .form-title { font-family:'Playfair Display',serif; font-size:1.7rem; color:var(--navy); margin-bottom:0.35rem; }
  .form-subtitle { color:#6b7280; font-size:0.88rem; margin-bottom:2rem; }

  .form-group { margin-bottom:1.25rem; }
  label { display:block; font-size:0.78rem; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#374151; margin-bottom:0.5rem; }
  input[type=text], input[type=date], textarea {
    width:100%; padding:0.8rem 1rem; border:1.5px solid #e5e7eb;
    border-radius:12px; font-size:0.9rem; font-family:'DM Sans',sans-serif; color:#1f2937;
    background:#fafaf8; outline:none; transition:border-color 0.2s, box-shadow 0.2s; box-sizing:border-box;
  }
  input:focus, textarea:focus { border-color:#d97706; box-shadow:0 0 0 3px rgba(217,119,6,0.1); background:#fff; }
  textarea { resize:vertical; min-height:100px; }

  .submit-btn { width:100%; background:linear-gradient(135deg,#f59e0b,#d97706); color:#fff; padding:0.9rem; border:none; border-radius:12px; font-size:1rem; font-weight:700; font-family:'DM Sans',sans-serif; cursor:pointer; box-shadow:0 6px 20px rgba(217,119,6,0.3); transition:transform 0.2s, box-shadow 0.2s; margin-top:0.5rem; }
  .submit-btn:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(217,119,6,0.4); }
  .back-link { display:inline-flex; align-items:center; gap:0.4rem; color:var(--teal); font-size:0.83rem; font-weight:600; text-decoration:none; margin-top:1.25rem; }
  .back-link:hover { text-decoration:underline; }

  @media(max-width:480px){
    .form-card { padding:1.75rem 1.25rem; }
    .form-title { font-size:1.4rem; }
  }
</style>

<div class="form-page">
  <div class="form-card">
    <div class="form-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    </div>
    <h1 class="form-title">Edit Progress Entry</h1>
    <p class="form-subtitle">Update your progress details and reflections.</p>

    <form action="{{ route('user_progress.update', $user_progress->id) }}" method="POST">
      @csrf @method('PUT')
      <div class="form-group">
        <label for="progress_title">Title</label>
        <input type="text" id="progress_title" name="progress_title" value="{{ old('progress_title', $user_progress->progress_title) }}" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" required>{{ old('description', $user_progress->description) }}</textarea>
      </div>
      <div class="form-group">
        <label for="progress_date">Date</label>
        <input type="date" id="progress_date" name="progress_date" value="{{ old('progress_date', $user_progress->progress_date ? $user_progress->progress_date->format('Y-m-d') : '') }}" required>
      </div>
      <button type="submit" class="submit-btn">Update Progress ✓</button>
    </form>

    <a href="{{ route('user_progress.index') }}" class="back-link">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Back to Progress
    </a>
  </div>
</div>

@endsection