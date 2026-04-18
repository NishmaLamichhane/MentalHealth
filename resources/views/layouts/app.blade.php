<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Relief Admin') }} — Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        :root {
            --sidebar-w: 260px;
            --blue: #2563eb;
            --blue-mid: #3b82f6;
            --blue-light: #eff6ff;
            --blue-xlight: #f8fbff;
            --navy: #0f172a;
            --sidebar-bg: #0f172a;
            --sidebar-active: rgba(59,130,246,0.15);
            --sidebar-border: rgba(59,130,246,0.2);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
        }
        body.dark { background: #0f172a; color: #e2e8f0; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 50;
            box-shadow: 4px 0 24px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }

        /* Logo area */
        .sidebar-logo {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex; align-items: center; gap: 0.75rem;
        }
        .sidebar-logo img {
            width: 40px; height: 40px; border-radius: 10px;
            background: #1e3a5f;
        }
        .sidebar-logo-text .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; font-weight: 700;
            color: #fff; line-height: 1.2;
        }
        .sidebar-logo-text .sub {
            font-size: 0.6rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.12em;
            color: #3b82f6;
        }

        /* Nav */
        .sidebar-nav {
            flex: 1; padding: 1rem 0.75rem;
            overflow-y: auto;
        }
        .nav-section-label {
            font-size: 0.6rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.14em;
            color: rgba(255,255,255,0.25);
            padding: 0.75rem 0.75rem 0.35rem;
        }
        .nav-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 0.9rem;
            border-radius: 10px;
            font-size: 0.875rem; font-weight: 500;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 2px;
            position: relative;
        }
        .nav-link i {
            font-size: 1rem; width: 20px; text-align: center;
            color: rgba(255,255,255,0.4);
            transition: color 0.2s ease;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.9);
        }
        .nav-link:hover i { color: #60a5fa; }
        .nav-link.active {
            background: var(--sidebar-active);
            color: #93c5fd;
            border: 1px solid var(--sidebar-border);
        }
        .nav-link.active i { color: #60a5fa; }
        .nav-link.active::before {
            content: '';
            position: absolute; left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 60%; border-radius: 0 3px 3px 0;
            background: #3b82f6;
        }

        /* Sidebar footer */
        .sidebar-footer {
            padding: 1rem 0.75rem;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .logout-btn {
            display: flex; align-items: center; gap: 0.75rem;
            width: 100%; padding: 0.65rem 0.9rem;
            border-radius: 10px;
            font-size: 0.875rem; font-weight: 600;
            color: #fca5a5;
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.15);
            cursor: pointer; transition: all 0.2s ease;
        }
        .logout-btn i { font-size: 1rem; }
        .logout-btn:hover {
            background: rgba(239,68,68,0.15);
            color: #f87171;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            height: 64px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky; top: 0; z-index: 40;
            box-shadow: 0 1px 8px rgba(0,0,0,0.04);
        }
        .dark .topbar { background: #1e293b; border-color: #334155; }

        .topbar-left { display: flex; align-items: center; gap: 1rem; }
        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; font-weight: 700; color: #0f172a;
        }
        .dark .topbar-title { color: #f1f5f9; }
        .topbar-breadcrumb {
            font-size: 0.75rem; color: #94a3b8; margin-top: 1px;
        }

        .topbar-right { display: flex; align-items: center; gap: 0.75rem; }

        /* Theme toggle */
        .theme-toggle {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: #f1f5f9; border: 1px solid #e2e8f0;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #64748b;
            font-size: 1rem; transition: all 0.2s ease;
        }
        .dark .theme-toggle { background: #334155; border-color: #475569; color: #94a3b8; }
        .theme-toggle:hover { background: #e2e8f0; color: #1e293b; }

        /* Admin badge */
        .admin-badge {
            display: flex; align-items: center; gap: 0.6rem;
            background: #eff6ff; border: 1px solid #bfdbfe;
            border-radius: 10px; padding: 0.4rem 0.85rem;
        }
        .admin-avatar {
            width: 28px; height: 28px; border-radius: 8px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; color: white;
        }
        .admin-name { font-size: 0.8rem; font-weight: 600; color: #1e40af; }

        /* ===== MAIN LAYOUT ===== */
        .layout-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex; flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
            padding: 1.75rem 2rem;
            background: #f1f5f9;
        }
        .dark .main-content { background: #0f172a; }

        /* Mobile toggle */
        .mobile-sidebar-toggle {
            display: none;
            width: 36px; height: 36px;
            border-radius: 10px;
            background: #f1f5f9; border: 1px solid #e2e8f0;
            align-items: center; justify-content: center;
            cursor: pointer; font-size: 1rem; color: #64748b;
        }

        /* ===== SHARED COMPONENT STYLES ===== */

        /* Page header */
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;
        }
        .page-title-wrap {}
        .page-label {
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.12em;
            text-transform: uppercase; color: #3b82f6; margin-bottom: 3px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem; font-weight: 700; color: #0f172a;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .dark .page-title { color: #f1f5f9; }
        .page-title i { font-size: 1.3rem; color: #3b82f6; }

        /* Add button */
        .btn-primary {
            display: inline-flex; align-items: center; gap: 6px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white; padding: 0.65rem 1.25rem;
            border-radius: 10px; font-size: 0.83rem; font-weight: 700;
            text-decoration: none; border: none; cursor: pointer;
            box-shadow: 0 4px 14px rgba(37,99,235,0.3);
            transition: all 0.2s ease; white-space: nowrap;
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(37,99,235,0.4); }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: 6px;
            background: white; color: #374151; padding: 0.65rem 1.25rem;
            border-radius: 10px; font-size: 0.83rem; font-weight: 600;
            text-decoration: none; border: 1.5px solid #e2e8f0; cursor: pointer;
            transition: all 0.2s ease; white-space: nowrap;
        }
        .btn-secondary:hover { background: #f8fafc; border-color: #bfdbfe; color: #1d4ed8; }

        /* Table card */
        .table-card {
            background: white; border-radius: 1.1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .dark .table-card { background: #1e293b; border-color: #334155; }

        .tbl { width: 100%; border-collapse: collapse; }
        .tbl thead th {
            background: #f8fafc; padding: 0.8rem 1rem;
            font-size: 0.68rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.08em; color: #64748b; text-align: left;
            border-bottom: 2px solid #e2e8f0; white-space: nowrap;
        }
        .dark .tbl thead th { background: #0f172a; border-color: #334155; color: #94a3b8; }
        .tbl tbody td {
            padding: 0.85rem 1rem; font-size: 0.845rem; color: #374151;
            border-bottom: 1px solid #f1f5f9; vertical-align: middle;
        }
        .dark .tbl tbody td { color: #cbd5e1; border-color: #334155; }
        .tbl tbody tr:hover { background: #f8fafc; }
        .dark .tbl tbody tr:hover { background: #273548; }
        .tbl tbody tr:last-child td { border-bottom: none; }
        .tbl-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }

        /* Action buttons */
        .act-edit {
            display: inline-flex; align-items: center; gap: 4px;
            color: #2563eb; background: #eff6ff;
            padding: 4px 10px; border-radius: 7px;
            font-size: 0.75rem; font-weight: 600;
            text-decoration: none; transition: all 0.2s ease;
            border: 1px solid #bfdbfe;
        }
        .act-edit:hover { background: #dbeafe; }
        .act-delete {
            display: inline-flex; align-items: center; gap: 4px;
            color: #dc2626; background: #fef2f2;
            padding: 4px 10px; border-radius: 7px;
            font-size: 0.75rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s ease;
            border: 1px solid #fecaca;
        }
        .act-delete:hover { background: #fee2e2; }

        /* Status badges */
        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 9px; border-radius: 999px;
            font-size: 0.68rem; font-weight: 700; white-space: nowrap;
        }
        .badge-dot { width: 5px; height: 5px; border-radius: 50%; }
        .badge-pending  { background: #fef9c3; color: #854d0e; }
        .badge-pending .badge-dot  { background: #eab308; }
        .badge-approved { background: #d1fae5; color: #065f46; }
        .badge-approved .badge-dot { background: #10b981; }
        .badge-rejected { background: #fee2e2; color: #991b1b; }
        .badge-rejected .badge-dot { background: #ef4444; }
        .badge-active   { background: #d1fae5; color: #065f46; }
        .badge-inactive { background: #f1f5f9; color: #64748b; }

        /* Delete modal */
        .del-modal {
            position: fixed; inset: 0; z-index: 200;
            background: rgba(15,23,42,0.6); backdrop-filter: blur(6px);
            display: none; align-items: center; justify-content: center;
            padding: 1rem;
        }
        .del-modal.open { display: flex; }
        .del-modal-box {
            background: white; border-radius: 1.25rem; width: 100%; max-width: 380px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2); overflow: hidden;
            animation: popIn 0.25s cubic-bezier(0.34,1.56,0.64,1);
        }
        @keyframes popIn { from { transform: scale(0.88) translateY(16px); opacity:0; } to { transform: scale(1) translateY(0); opacity:1; } }
        .del-modal-top { height: 5px; background: linear-gradient(90deg, #ef4444, #f97316); }
        .del-modal-body { padding: 2rem 1.75rem; text-align: center; }

        /* Flash message */
        .flash-msg {
            display: flex; align-items: center; gap: 10px;
            background: #d1fae5; border: 1px solid #6ee7b7;
            border-left: 4px solid #10b981;
            color: #065f46; padding: 0.85rem 1.1rem;
            border-radius: 0.75rem; margin-bottom: 1.5rem;
            font-size: 0.85rem; font-weight: 500;
        }

        /* Empty state */
        .empty-state {
            text-align: center; padding: 4rem 1.5rem;
            color: #94a3b8;
        }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .layout-wrapper { margin-left: 0; }
            .mobile-sidebar-toggle { display: flex; }
            .main-content { padding: 1.25rem; }
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('image/logoo.png') }}" alt="Relief">
            <div class="sidebar-logo-text">
                <div class="brand">Relief</div>
                <div class="sub">Admin Panel</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main Menu</div>

            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="ri-dashboard-3-line"></i>
                Dashboard
            </a>
            <a href="{{ route('specialist.index') }}" class="nav-link {{ request()->routeIs('specialist.*') ? 'active' : '' }}">
                <i class="ri-user-star-line"></i>
                Specialists
            </a>
            <a href="{{ route('therapist.index') }}" class="nav-link {{ request()->routeIs('therapist.*') ? 'active' : '' }}">
                <i class="ri-psychotherapy-line"></i>
                Therapists
            </a>
            <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                <i class="ri-price-tag-3-line"></i>
                Categories
            </a>
            <a href="{{ route('mindfulness_activities.index') }}" class="nav-link {{ request()->routeIs('mindfulness_activities.*') ? 'active' : '' }}">
                <i class="ri-mental-health-line"></i>
                Mindfulness
            </a>

            <div class="nav-section-label" style="margin-top:0.5rem;">Appointments</div>

            <a href="{{ route('bookings.approve') }}" class="nav-link {{ request()->routeIs('bookings.approve') ? 'active' : '' }}">
                <i class="ri-calendar-check-line"></i>
                Approval Queue
            </a>
            <a href="{{ route('bookings.history') }}" class="nav-link {{ request()->routeIs('bookings.history') ? 'active' : '' }}">
                <i class="ri-history-line"></i>
                Booking History
            </a>

            <div class="nav-section-label" style="margin-top:0.5rem;">System</div>

            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="ri-group-line"></i>
                Users
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="ri-logout-box-r-line"></i>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN LAYOUT -->
    <div class="layout-wrapper">
        <!-- TOPBAR -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="mobile-sidebar-toggle" id="sidebarToggle">
                    <i class="ri-menu-2-line"></i>
                </button>
                <div>
                    <div class="topbar-title">Relief Admin</div>
                </div>
            </div>
            <div class="topbar-right">
                <button id="theme-toggle" class="theme-toggle" type="button">
                    <i id="theme-toggle-dark-icon" class="ri-moon-line hidden"></i>
                    <i id="theme-toggle-light-icon" class="ri-sun-line hidden"></i>
                </button>
                <div class="admin-badge">
                    <div class="admin-avatar">A</div>
                    <span class="admin-name">Admin</span>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="main-content">
            @include('layouts.alert')
            @yield('content')
        </main>
    </div>

    <!-- Mobile overlay -->
    <div id="sidebarOverlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:49; backdrop-filter:blur(2px);" onclick="closeSidebar()"></div>

    <script>
        // Theme toggle
        var darkIcon  = document.getElementById('theme-toggle-dark-icon');
        var lightIcon = document.getElementById('theme-toggle-light-icon');
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            lightIcon.classList.remove('hidden');
        } else {
            darkIcon.classList.remove('hidden');
        }
        document.getElementById('theme-toggle').addEventListener('click', function() {
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        });

        // Mobile sidebar
        function openSidebar() {
            document.getElementById('sidebar').classList.add('open');
            document.getElementById('sidebarOverlay').style.display = 'block';
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').style.display = 'none';
        }
        document.getElementById('sidebarToggle').addEventListener('click', openSidebar);

        // Global delete modal helpers
        function showPopup(id, url) {
            var modal = document.getElementById('popup');
            modal.classList.add('open');
            document.body.style.overflow = 'hidden';
            var form = document.getElementById('deleteForm');
            form.action = url || (form.dataset.baseUrl + '/' + id);
        }
        function hidePopup() {
            document.getElementById('popup').classList.remove('open');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') hidePopup(); });
    </script>
</body>
</html>