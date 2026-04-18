<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Support - Relief</title>
    <link rel="icon" href="{{ asset('image/logopeace.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap');

        html { scroll-behavior: smooth; }

        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #60a5fa, #a78bfa);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        .nav-link:hover::after {
            width: 100%;
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .gradient-text {
            background: linear-gradient(135deg, #93c5fd, #c4b5fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-glow {
            filter: drop-shadow(0 0 12px rgba(96, 165, 250, 0.25));
            transition: filter 0.4s ease;
        }
        .logo-glow:hover {
            filter: drop-shadow(0 0 20px rgba(96, 165, 250, 0.4));
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.3);
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .mobile-menu.open {
            max-height: 700px;
        }

        .footer-link {
            position: relative;
            display: inline-block;
            transition: color 0.3s ease, padding-left 0.3s ease;
        }
        .footer-link:hover {
            color: #93c5fd;
            padding-left: 6px;
        }

        .social-icon {
            transition: all 0.3s ease;
        }
        .social-icon:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(96, 165, 250, 0.3);
        }

        .cta-pulse {
            position: relative;
            overflow: hidden;
        }
        .cta-pulse::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        .cta-pulse:hover::before {
            transform: translateX(100%);
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #1e3a5f; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; }

        @keyframes ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-scroll {
            animation: ticker 30s linear infinite;
        }
        .ticker-scroll:hover {
            animation-play-state: paused;
        }

        .back-to-top {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col font-[Inter,sans-serif]">

    <!-- ============================================ -->
    <!-- TOP ANNOUNCEMENT BAR -->
    <!-- ============================================ -->
    <div class="bg-gradient-to-r from-blue-950 via-blue-900 to-indigo-950 text-blue-200 text-xs py-1.5 overflow-hidden relative">
        <div class="flex whitespace-nowrap ticker-scroll">
            <span class="mx-8 flex items-center gap-1.5"><i class="ri-heart-pulse-line text-blue-400"></i> Your mental health matters — free consultation for first-time users</span>
            <span class="mx-8 flex items-center gap-1.5"><i class="ri-phone-line text-blue-400"></i> Crisis Helpline: 9865162745 — Available 24/7</span>
            <span class="mx-8 flex items-center gap-1.5"><i class="ri-shield-check-line text-blue-400"></i> 100% Confidential & Secure Sessions</span>
            <span class="mx-8 flex items-center gap-1.5"><i class="ri-calendar-check-line text-blue-400"></i> Book appointments online — no wait times</span>
            <span class="mx-8 flex items-center gap-1.5"><i class="ri-heart-pulse-line text-blue-400"></i> Your mental health matters — free consultation for first-time users</span>
            <span class="mx-8 flex items-center gap-1.5"><i class="ri-phone-line text-blue-400"></i> Crisis Helpline: 9865162745 — Available 24/7</span>
            <span class="mx-8 flex items-center gap-1.5"><i class="ri-shield-check-line text-blue-400"></i> 100% Confidential & Secure Sessions</span>
            <span class="mx-8 flex items-center gap-1.5"><i class="ri-calendar-check-line text-blue-400"></i> Book appointments online — no wait times</span>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- MAIN NAVIGATION -->
    <!-- ============================================ -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-200/60 shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-18">

                <!-- Logo & Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0 group">
                    <img src="{{ asset('image/logoo.png') }}" alt="Relief Logo"
                         class="w-10 h-10 lg:w-11 lg:h-11 rounded-xl logo-glow bg-blue-500 transition-transform duration-300 group-hover:scale-105">
                    <div class="hidden sm:block">
                        <span class="text-xl font-bold text-gray-900 tracking-tight font-[Playfair_Display,serif]">Relief</span>
                        <span class="block text-[10px] uppercase tracking-[0.2em] text-blue-500 font-medium -mt-0.5">Mental Wellness</span>
                    </div>
                </a>

                <!-- Desktop Search -->
                <form action="{{ route('search') }}" method="GET"
                      class="hidden lg:flex items-center relative group">
                    <div class="relative">
                        <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm transition-colors group-focus-within:text-blue-500"></i>
                        <input type="search"
                               name="search"
                               value="{{ request()->query('search') }}"
                               placeholder="Search therapists, topics, resources..."
                               class="search-input w-72 xl:w-80 pl-9 pr-4 py-2 text-sm bg-gray-100 border border-transparent rounded-full focus:bg-white focus:border-blue-300 focus:outline-none transition-all duration-300 placeholder:text-gray-400">
                    </div>
                </form>

                <!-- ========================================== -->
                <!-- BUG FIX: All desktop links in ONE div      -->
                <!-- Previously: two nested <div hidden lg:flex> -->
                <!-- The first one was never closed, which hid   -->
                <!-- the mobile toggle button inside it            -->
                <!-- ========================================== -->
                <div class="hidden lg:flex items-center gap-1">

                    <a href="{{ route('home') }}"
                       class="nav-link px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="ri-home-4-line mr-1 text-xs"></i>Home
                    </a>

                    <a href="{{ route('about') }}"
                       class="nav-link px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="ri-information-line mr-1 text-xs"></i>About Us
                    </a>

                    <a href="{{ route('activities') }}"
                       class="nav-link px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="ri-video-line mr-1 text-xs"></i>Videos
                    </a>

                    <!-- Specialists Dropdown -->
                    <div class="dropdown relative">
                        <button class="nav-link px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 flex items-center gap-1">
                            <i class="ri-user-heart-line mr-1 text-xs"></i>Specialists
                            <i class="ri-arrow-down-s-line text-xs"></i>
                        </button>
                        <div class="dropdown-menu absolute top-full left-0 mt-1 w-56 bg-white rounded-xl border border-gray-200/80 shadow-xl shadow-gray-200/50 py-2 z-50">
                            <div class="px-3 py-1.5 border-b border-gray-100 mb-1">
                                <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Our Specialists</p>
                            </div>
                            @php
                                $specialists = App\Models\Specialist::orderBy('priority')->get();
                            @endphp
                            @foreach($specialists as $specialist)
                            <a href="{{ route('specialisttherapist', $specialist->id) }}"
                               class="flex items-center gap-3 px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition-colors rounded-lg mx-1 w-[calc(100%-8px)]">
                                <span class="w-7 h-7 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center text-blue-600 text-xs font-semibold shrink-0">
                                    {{ Str::substr($specialist->name, 0, 1) }}
                                </span>
                                {{ $specialist->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                </div>
                <!-- ========================================== -->
                <!-- END desktop links (properly closed)        -->
                <!-- ========================================== -->

                <!-- Desktop Right Actions -->
                <div class="hidden lg:flex items-center gap-3">
                    @auth
                    <div class="dropdown relative">
                        <button class="flex items-center gap-2 pl-3 pr-2 py-1.5 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                            <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name ?? 'Profile' }}</span>
                            <span class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold shadow-md">
                                {{ Str::upper(Str::substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </span>
                        </button>
                        <div class="dropdown-menu absolute top-full right-0 mt-2 w-64 bg-white rounded-xl border border-gray-200/80 shadow-xl shadow-gray-200/50 py-2 z-50">
                            <div class="px-4 py-3 border-b border-gray-100 mb-1">
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                <span class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500"><i class="ri-calendar-check-line"></i></span>
                                My Appointments
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                <span class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center text-violet-500"><i class="ri-user-settings-line"></i></span>
                                My Profile
                            </a>
                            <a href="{{ route('user_progress.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                <span class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500"><i class="ri-line-chart-line"></i></span>
                                Progress Tracker
                            </a>
                            <div class="border-t border-gray-100 mt-1 pt-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                        <span class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center"><i class="ri-logout-box-r-line"></i></span>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors px-3 py-2">
                        Sign In
                    </a>
                    <a href="{{ route('register') ?? '#' }}"
                       class="cta-pulse text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 px-5 py-2.5 rounded-full shadow-md shadow-blue-200 transition-all duration-300 hover:shadow-lg hover:shadow-blue-300">
                        Get Started
                    </a>
                    @endauth
                </div>

                <!-- ========================================== -->
                <!-- MOBILE MENU TOGGLE BUTTON                -->
                <!-- This was trapped inside the unclosed div   -->
                <!-- Now it's a direct child of the flex row    -->
                <!-- so it renders properly on mobile            -->
                <!-- ========================================== -->
                <button id="mobileToggle"
                        class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors"
                        aria-label="Toggle menu">
                    <i class="ri-menu-3-line text-xl text-gray-700 open-icon"></i>
                    <i class="ri-close-line text-xl text-gray-700 close-icon hidden"></i>
                </button>

            </div>

            <!-- ========================================== -->
            <!-- MOBILE MENU PANEL                         -->
            <!-- Added About Us link that was missing       -->
            <!-- ========================================== -->
            <div id="mobileMenu" class="mobile-menu lg:hidden border-t border-gray-100">
                <div class="py-4 space-y-1">

                    <!-- Mobile Search -->
                    <form action="{{ route('search') }}" method="GET" class="px-1 pb-3">
                        <div class="relative">
                            <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="search" name="search"
                                   value="{{ request()->query('search') }}"
                                   placeholder="Search..."
                                   class="w-full pl-9 pr-4 py-2.5 text-sm bg-gray-100 rounded-xl border-0 focus:bg-white focus:ring-2 focus:ring-blue-300 focus:outline-none transition-all">
                        </div>
                    </form>

                    <!-- Nav Links -->
                    <a href="{{ route('home') }}"
                       class="flex items-center gap-3 px-3 py-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition-colors">
                        <i class="ri-home-4-line text-lg text-gray-400"></i>Home
                    </a>

                    <!-- About Us — was missing before -->
                    <a href="{{ route('about') }}"
                       class="flex items-center gap-3 px-3 py-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition-colors">
                        <i class="ri-information-line text-lg text-gray-400"></i>About Us
                    </a>

                    <a href="{{ route('activities') }}"
                       class="flex items-center gap-3 px-3 py-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition-colors">
                        <i class="ri-video-line text-lg text-gray-400"></i>Videos
                    </a>

                    <!-- Mobile Specialists Accordion -->
                    <div>
                        <button id="mobileSpecToggle"
                                class="flex items-center justify-between w-full px-3 py-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition-colors">
                            <span class="flex items-center gap-3">
                                <i class="ri-user-heart-line text-lg text-gray-400"></i>Specialists
                            </span>
                            <i class="ri-arrow-down-s-line text-lg transition-transform duration-200" id="specArrow"></i>
                        </button>
                        <div id="mobileSpecMenu" class="hidden pl-10 pb-1 space-y-0.5">
                            @foreach($specialists as $specialist)
                            <a href="{{ route('specialisttherapist', $specialist->id) }}"
                               class="block px-3 py-2 text-sm text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                {{ $specialist->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Auth Section -->
                    <div class="border-t border-gray-100 pt-3 mt-3 space-y-1">
                        @auth
                        <a href="{{ route('bookings.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition-colors">
                            <i class="ri-calendar-check-line text-lg text-gray-400"></i>My Appointments
                        </a>
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-3 px-3 py-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition-colors">
                            <i class="ri-user-settings-line text-lg text-gray-400"></i>My Profile
                        </a>
                        <a href="{{ route('user_progress.index') }}"
                           class="flex items-center gap-3 px-3 py-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition-colors">
                            <i class="ri-line-chart-line text-lg text-gray-400"></i>Progress Tracker
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="flex items-center gap-3 w-full px-3 py-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                                <i class="ri-logout-box-r-line text-lg"></i>Sign Out
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}"
                           class="flex items-center gap-3 px-3 py-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-xl transition-colors">
                            <i class="ri-login-box-line text-lg text-gray-400"></i>Sign In
                        </a>
                        <a href="{{ route('register') ?? '#' }}"
                           class="block mx-3 text-center text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 rounded-xl">
                            Get Started
                        </a>
                        @endauth
                    </div>
                </div>
            </div>

        </nav>
    </header>

    <!-- ============================================ -->
    <!-- MAIN CONTENT -->
    <!-- ============================================ -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ============================================ -->
    <!-- FOOTER -->
    <!-- ============================================ -->
    <footer class="relative bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 text-gray-300 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 overflow-hidden leading-none -translate-y-[99%]">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 60V20C240 0 480 40 720 30C960 20 1200 0 1440 20V60H0Z" fill="#0f172a"/>
            </svg>
        </div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-900/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">

                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-5 group">
                        <img src="{{ asset('image/logoo.png') }}" alt="Relief Logo"
                             class="w-11 h-11 rounded-xl logo-glow transition-transform duration-300 group-hover:scale-105">
                        <div>
                            <span class="text-xl font-bold text-white tracking-tight font-[Playfair_Display,serif]">Relief</span>
                            <span class="block text-[10px] uppercase tracking-[0.2em] text-blue-400 font-medium -mt-0.5">Mental Wellness</span>
                        </div>
                    </a>
                    <p class="text-sm text-gray-400 leading-relaxed mb-6">
                        Providing compassionate mental health support through expert therapists, guided resources, and a safe community — because healing begins with a conversation.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="#" class="social-icon w-9 h-9 rounded-lg bg-white/5 hover:bg-blue-600 flex items-center justify-center text-gray-400 hover:text-white border border-white/10 hover:border-blue-600 transition-all duration-300"><i class="ri-facebook-fill text-sm"></i></a>
                        <a href="#" class="social-icon w-9 h-9 rounded-lg bg-white/5 hover:bg-pink-600 flex items-center justify-center text-gray-400 hover:text-white border border-white/10 hover:border-pink-600 transition-all duration-300"><i class="ri-instagram-line text-sm"></i></a>
                        <a href="#" class="social-icon w-9 h-9 rounded-lg bg-white/5 hover:bg-sky-500 flex items-center justify-center text-gray-400 hover:text-white border border-white/10 hover:border-sky-500 transition-all duration-300"><i class="ri-twitter-x-line text-sm"></i></a>
                        <a href="#" class="social-icon w-9 h-9 rounded-lg bg-white/5 hover:bg-blue-700 flex items-center justify-center text-gray-400 hover:text-white border border-white/10 hover:border-blue-700 transition-all duration-300"><i class="ri-linkedin-box-fill text-sm"></i></a>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-5 flex items-center gap-2">
                        <span class="w-5 h-0.5 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full"></span>
                        Quick Links
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="footer-link text-sm text-gray-400 hover:text-blue-300"><i class="ri-arrow-right-s-line text-xs"></i>Home</a></li>
                        <li><a href="{{ route('about') }}" class="footer-link text-sm text-gray-400 hover:text-blue-300"><i class="ri-arrow-right-s-line text-xs"></i>About Us</a></li>
                        <li><a href="{{ route('activities') }}" class="footer-link text-sm text-gray-400 hover:text-blue-300"><i class="ri-arrow-right-s-line text-xs"></i>Video Resources</a></li>
                        <li><a href="{{ route('home') }}#therapists" class="footer-link text-sm text-gray-400 hover:text-blue-300"><i class="ri-arrow-right-s-line text-xs"></i>Our Specialists</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-5 flex items-center gap-2">
                        <span class="w-5 h-0.5 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full"></span>
                        Contact Us
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 shrink-0 mt-0.5"><i class="ri-map-pin-line text-sm"></i></span>
                            <span class="text-sm text-gray-400 leading-relaxed">Ratnanagar-1, Bakulahar,<br>Chitwan, Nepal</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 shrink-0"><i class="ri-phone-line text-sm"></i></span>
                            <a href="tel:9865162745" class="text-sm text-gray-400 hover:text-emerald-300 transition-colors">+977 9865162745</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center text-violet-400 shrink-0"><i class="ri-mail-line text-sm"></i></span>
                            <a href="mailto:support@mentalhealth.com" class="text-sm text-gray-400 hover:text-violet-300 transition-colors">support@mentalhealth.com</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center text-amber-400 shrink-0"><i class="ri-time-line text-sm"></i></span>
                            <span class="text-sm text-gray-400">Mon–Sat: 8:00 AM – 8:00 PM</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-5 flex items-center gap-2">
                        <span class="w-5 h-0.5 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full"></span>
                        Stay Connected
                    </h3>
                    <p class="text-sm text-gray-400 mb-4 leading-relaxed">Get wellness tips, new resources, and updates delivered to your inbox.</p>
                    <form class="space-y-2.5" onsubmit="event.preventDefault(); this.querySelector('input').value=''; showToast();">
                        <div class="relative">
                            <i class="ri-mail-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                            <input type="email" placeholder="Enter your email"
                                   class="w-full pl-9 pr-4 py-2.5 text-sm bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-gray-500 focus:outline-none focus:border-blue-500 focus:bg-white/10 transition-all duration-300">
                        </div>
                        <button type="submit"
                                class="cta-pulse w-full text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 py-2.5 rounded-xl shadow-lg shadow-blue-900/30 transition-all duration-300">
                            Subscribe
                        </button>
                    </form>
                    <div class="mt-5 p-3 bg-red-500/10 border border-red-500/20 rounded-xl">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="ri-alarm-warning-line text-red-400 text-sm"></i>
                            <span class="text-xs font-semibold text-red-300 uppercase tracking-wide">In Crisis?</span>
                        </div>
                        <p class="text-xs text-red-300/70 leading-relaxed">
                            If you're in immediate danger, please call your local emergency services or reach out to our 24/7 helpline.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-500">&copy; {{ date('Y') }} Relief Mental Wellness. All rights reserved.</p>
                <div class="flex items-center gap-5">
                    <a href="#" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Privacy Policy</a>
                    <span class="text-gray-700">·</span>
                    <a href="#" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Terms of Service</a>
                    <span class="text-gray-700">·</span>
                    <a href="#" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ============================================ -->
    <!-- BACK TO TOP BUTTON -->
    <!-- ============================================ -->
    <button id="backToTop"
            class="back-to-top fixed bottom-6 right-6 z-50 w-11 h-11 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-300/30 flex items-center justify-center hover:shadow-xl hover:shadow-blue-400/40 hover:-translate-y-0.5 transition-all duration-300"
            aria-label="Back to top">
        <i class="ri-arrow-up-line text-lg"></i>
    </button>

    <!-- ============================================ -->
    <!-- TOAST NOTIFICATION -->
    <!-- ============================================ -->
    <div id="toast"
         class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[100] bg-emerald-600 text-white text-sm font-medium px-5 py-3 rounded-xl shadow-xl shadow-emerald-900/30 flex items-center gap-2 transition-all duration-300 opacity-0 translate-y-4 pointer-events-none">
        <i class="ri-check-line"></i>
        <span>Subscribed successfully!</span>
    </div>

    <!-- ============================================ -->
    <!-- SCRIPTS -->
    <!-- ============================================ -->
    <script>
        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const openIcon = mobileToggle.querySelector('.open-icon');
        const closeIcon = mobileToggle.querySelector('.close-icon');

        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Mobile specialists accordion
        const mobileSpecToggle = document.getElementById('mobileSpecToggle');
        const mobileSpecMenu = document.getElementById('mobileSpecMenu');
        const specArrow = document.getElementById('specArrow');

        if (mobileSpecToggle) {
            mobileSpecToggle.addEventListener('click', () => {
                mobileSpecMenu.classList.toggle('hidden');
                specArrow.style.transform = mobileSpecMenu.classList.contains('hidden')
                    ? 'rotate(0deg)' : 'rotate(180deg)';
            });
        }

        // Back to top button
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            backToTop.classList.toggle('visible', window.scrollY > 400);
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Toast notification
        function showToast() {
            const toast = document.getElementById('toast');
            toast.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
            toast.classList.add('opacity-100', 'translate-y-0');
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                toast.classList.remove('opacity-100', 'translate-y-0');
            }, 3000);
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Close mobile menu when clicking a link
        mobileMenu.querySelectorAll('a:not([href="#"])').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('open');
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            });
        });
    </script>
</body>

</html>