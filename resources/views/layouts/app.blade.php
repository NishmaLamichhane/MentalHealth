<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
        rel="stylesheet" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="font-sans antialiased dark:bg-slate-800">
    <div class="fixed lg:absolute z-50 right-4 top-5">

        <div class="relative">
            <div class="flex items-center gap-x-2">
                <div>
                    <button id="theme-toggle" type="button"
                        class="text-gray-900 dark:text-gray-300 hover:bg-gray-400 border-gray-300 dark:hover:bg-gray-700 dark:border-gray-700 focus:outline-none rounded-lg text-sm  lg:py-0.5 lg:px-3 py-0.5 px-2">
                        <p id="theme-toggle-dark-icon" class="hidden  lg:text-sm">
                            <i class="ri-moon-fill"></i>
                        </p>
                        <p id="theme-toggle-light-icon" class="hidden  lg:text-sm">
                            <i class="ri-sun-fill"></i>
                        </p>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.alert')
    <div class="flex">
        <nav class="w-70 h-100% shadow-lg bg-black dark:bg-slate-900 dark:text-white flex flex-col justify-between">
            <div>
            <img src="{{ asset('image/logoo.png') }}" alt="" class="w-60 ml-5 h-60 mt-4">

                <ul>
                    <li><a href="{{ route('dashboard') }}" class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl text-white"><i class="ri-dashboard-fill p-4 text-2xl"></i>Dashboard</a></li>
                    <li><a href="{{ route('specialist.index') }}" class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl text-white"><i class="ri-user-star-fill p-4 text-2xl"></i></i>Specialist</a></li>
                    <li><a href="{{ route('therapist.index') }}" class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl text-white"><i class="ri-psychotherapy-fill p-4 text-2xl"></i>Therapists</a></li>
                    <li><a href="{{ route('category.index') }}" class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl text-white"> <i class="ri-file-add-fill p-4 text-2xl"></i>Categories</a></li>
                    <li><a href="{{ route('mindfulness_activities.index') }}" class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl text-white"><i class="ri-empathize-fill p-4 text-2xl"></i>Mindfulness Activities</a></li>
                    <li><a href="{{route('bookings.approve')}}" class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl text-white"><i class="ri-contract-fill p-4 text-2xl"></i>Appointment Approval</a></li>
                    <li><a href="{{ route('users.index') }}" class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl text-white"><i class="ri-user-fill p-4 text-2xl"></i>Users</a></li>
                </ul>
            </div>

            <!-- Logout button at the bottom -->
            <div class=" p-11">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-gray-300 hover:bg-gray-200 p-2  text-black rounded-lg font-bold text-xl text-left">
                        <i class="ri-logout-box-line p-4 text-2xl"></i>Logout
                    </button>
                </form>
                </li>
            </div>
        </nav>
        <div class="p-4 flex-1 bg-gray-200 dark:bg-transparent">

            @yield('content')
        </div>
    </div>
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
    </script>
</body>

</html>