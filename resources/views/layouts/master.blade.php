<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Support - Relief</title>
    <link rel="icon" href="{{ asset('image/logopeace.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Top Bar -->
  

    <!-- Navigation -->
     
    <nav class="bg-blue-900 shadow-md p-4 pb-0 flex justify-between items-center flex-wrap">
        <img src="{{ asset('image/logoo.png') }}" alt="Logo" class="w-16 h-16 sm:h-16">

        <form action="{{route('search')}}" method="GET" class="flex items-center w-full sm:w-auto mt-2 sm:mt-0 space-x-2">
            <input type="search" class="border border-gray-300 rounded-md py-2 px-3 text-sm w-full sm:w-auto" placeholder="Search" name="search" value="{{ request()->query('search') }}">
            <button type="submit" class="bg-blue-600 text-white rounded-md px-4 py-2 text-sm hover:bg-red-400 transition duration-200">Search</button>
        </form>

        <div class="flex items-center space-x-4 mt-2 sm:mt-0">
            
            <a href="{{route('home')}}" class="text-white hover:text-blue-600 transition duration-200">Home</a>
          
            <a href="{{route('activities')}}" class="text-white hover:text-blue-600 transition duration-200">Videos</a>

            <div class="relative group">
                <button class="flex items-center gap-2 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                    Specialists
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <!-- Dropdown Content -->
                <div class="absolute left-0 mt-0 bg-white border border-gray-200 rounded-md shadow-lg hidden group-hover:block z-10">
                    @php
                    $specialists = App\Models\Specialist::orderBy('priority')->get();
                    @endphp
                    @foreach($specialists as $specialist)
                    <a href="{{ route('specialisttherapist', $specialist->id) }}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-blue-100">
                        {{ $specialist->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            @auth
            <div class="relative group">
                <button class="flex items-center gap-2 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                    <i class="ri-user-3-line"></i> Profile
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <!-- Dropdown Content -->
                <div class="absolute right-0 mt-0 bg-white border border-gray-200 rounded-md shadow-lg hidden group-hover:block z-10">
                    <a href="{{route('bookings.index')}}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">
                        <i class="ri-calendar-line"></i> My Appointments History
                    </a>
                    <a href="{{route('profile.edit')}}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">
                    <i class="ri-profile-fill"></i>My Profile
                    </a>
                    <a href="{{route('user_progress.index')}}" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">
                    <i class="ri-progress-5-line"></i> Progress Tracker
                    </a>
                    <form action="{{route('logout')}}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">
                            <i class="ri-logout-box-line"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{route('login')}}" class="text-white hover:text-blue-600 transition duration-200">
                <i class="ri-login-box-line text-white"></i> Login
            </a>
            @endauth
        </div>
        
    </nav>

    <!-- Main Content -->
    <main class="flex-grow p-4">
        @yield('content')
    
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-blue-900 py-8">
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <h1 class="text-lg font-semibold mb-2 text-white">About Us</h1>
                <p class="text-white">We aim to provide mental health support through expert therapists and mindfulness resources.</p>
            </div>
            <div>
                <h1 class="text-lg text-white font-semibold mb-2">Contact</h1>
                <p class="text-white">Address: Ratnanagar-1, Bakulahar</p>
                <p class="text-white">Phone: 9865162745</p>
                <p class="text-white">Email: support@mentalhealth.com</p>
            </div>
            <div>
                <h1 class="text-lg  text-white font-semibold mb-2">Social Media</h1>
                <p><a href="#" class="hover:underline text-white">Facebook</a></p>
                <p><a href="#" class="hover:underline text-white">Instagram</a></p>
                <p><a href="#" class="hover:underline text-white">Twitter</a></p>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
