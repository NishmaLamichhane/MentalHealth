@extends('layouts.master')
@section('content')
<div class="min-h-screen w-full bg-gradient-to-b from-sky-50 to-lavender-50">
    <!-- Hero Section -->
    @if(Route::currentRouteName() == 'home')
    <div class="relative w-full h-screen">
        <!-- Background Image -->
        <img src="{{ asset('imagess/therapist.jpg') }}" 
             alt="Therapist Background" 
             class="w-full h-full object-cover rounded-none shadow-xl">
        
        <!-- Content Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-transparent to-black/70 flex flex-col justify-center items-center text-center text-white p-4 sm:p-6 md:p-8 lg:p-12">
            <!-- Headline -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-4 sm:mb-6 leading-tight">
                Welcome to Your Path to Wellness
            </h1>

            <!-- Subheading -->
            <p class="text-base sm:text-lg md:text-xl mb-6 max-w-2xl font-medium">
                Discover expert therapists and mindfulness activities tailored for you. Empower your mental health journey today!
            </p>

            <!-- Call to Action -->
            <a href="#therapists" 
               class="bg-gradient-to-r from-sky-500 to-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:from-sky-600 hover:to-blue-700 hover:shadow-lg transition-all">
                Explore Therapists
            </a>
        </div>
    </div>
    @endif
</div>
<br><br><br>
<div class="px-16" id="therapists">
    <!-- Expert Therapists Section -->
    <div class="text-center mb-6">
    <h2 class="text-4xl font-bold text-sky-800">Our Available Expert Therapists</h2>
        <p class="text-gray-700">Our team of certified professionals is here to guide you.</p>
    </div>
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 text-center">
    @foreach($therapists as $therapist)
    <a href="{{ route('viewtherapist', $therapist->id) }}" class="group">
        <div class="bg-gray-100 p-6 rounded-lg shadow-md hover:shadow-xl transform hover:scale-105 transition duration-300">
            <!-- Therapist Image -->
            <img src="{{ asset('images/therapists/' . $therapist->photopath) }}"
                 alt="{{ $therapist->name }}"
                 class="w-24 h-24 mx-auto mb-4 rounded-full object-cover group-hover:scale-110 transform transition duration-300">

            <!-- Therapist Name -->
            <h3 class="text-xl font-bold text-blue-900 group-hover:text-blue-700 transition duration-300">
                {{ $therapist->name }}
            </h3>

            <!-- Therapist Description -->
            <p class="text-gray-600 text-sm mt-2 line-clamp-3  overflow-hidden" >
                {{ Str::limit($therapist->description, 80, '...') }}
            </p>

            <!-- Professional Details -->
            <div class="mt-4">
                <span class="inline-block bg-blue-100 text-blue-700 px-4 py-2 rounded-full  font-semibold text-sm">
                    {{ $therapist->specialization }}
                </span>
            </div>

            <!-- Button -->
            <button class="mt-4 bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                View Profile
            </button>

            <!-- Hover Effect -->
            <div class="absolute inset-0 bg-blue-100 opacity-0 group-hover:opacity-30 rounded-lg transition duration-300"></div>
        </div>
    </a>
    @endforeach
</div>
<h1 class="text-center font-bold text-sky-800 text-4xl m-8 ">Why to choose us?</h1>
<div class="flex flex-wrap justify-center gap-6 p-6 bg-gradient-to-b from-blue-50 via-white to-blue-50">
    <!-- Box 1 -->
    <div class="group relative max-w-sm bg-white shadow-lg rounded-2xl p-8 hover:scale-105 hover:shadow-2xl transition-transform">
        <div class="flex justify-center items-center mb-6">
            <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                <svg class="w-8 h-8 text-sky-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3 3v-6m9 3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <h3 class="text-xl font-bold text-center text-sky-800 mb-2">Expert Therapists</h3>
        <p class="text-gray-600 text-center">Connect with qualified professionals who are here to guide and support you in every step of your mental health journey.</p>
        <div class="absolute top-0 right-0 h-12 w-12 bg-sky-800 rounded-full transform translate-x-4 -translate-y-4 opacity-0 group-hover:opacity-100 transition-opacity">
            <span class="text-white text-lg font-bold absolute top-3 left-3">1</span>
        </div>
    </div>
    <!-- Box 3 -->
    <div class="group relative max-w-sm bg-white shadow-lg rounded-2xl p-8 hover:scale-105 hover:shadow-2xl transition-transform">
        <div class="flex justify-center items-center mb-6">
            <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                <svg class="w-8 h-8 text-sky-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
        </div>
        <h3 class="text-xl font-bold text-center text-sky-800 mb-2">Mindfulness Resources</h3>
        <p class="text-gray-600 text-center">Access curated mindfulness videos and tools designed to enhance your emotional well-being.</p>
        <div class="absolute top-0 right-0 h-12 w-12 bg-sky-800 rounded-full transform translate-x-4 -translate-y-4 opacity-0 group-hover:opacity-100 transition-opacity">
            <span class="text-white text-lg font-bold absolute top-3 left-3">2</span>
        </div>
    </div>

    <!-- Box 4 -->
    <div class="group relative max-w-sm bg-white shadow-lg rounded-2xl p-8 hover:scale-105 hover:shadow-2xl transition-transform">
        <div class="flex justify-center items-center mb-6">
            <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                <svg class="w-8 h-8 text-sky-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0018 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.437L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
        </div>
        <h3 class="text-xl font-bold text-center text-sky-800 mb-2">24/7 Support</h3>
        <p class="text-gray-600 text-center">Around the clock to assist you whenever you need guidance or assistance.</p>
        <div class="absolute top-0 right-0 h-12 w-12 bg-sky-800 rounded-full transform translate-x-4 -translate-y-4 opacity-0 group-hover:opacity-100 transition-opacity">
            <span class="text-white text-lg font-bold absolute top-3 left-3">3</span>
        </div>
    </div>

    <!-- Box 5 -->
    <div class="group relative max-w-sm bg-white shadow-lg rounded-2xl p-8 hover:scale-105 hover:shadow-2xl transition-transform">
        <div class="flex justify-center items-center mb-6">
            <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                <svg class="w-8 h-8 text-sky-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16m-7 4h7M4 14h4" />
                </svg>
            </div>
        </div>
        <h3 class="text-xl font-bold text-center text-sky-800 mb-2">Easy User Interface</h3>
        <p class="text-gray-600 text-center">Navigate effortlessly through our user-friendly platform designed to make your experience smooth and intuitive.</p>
        <div class="absolute top-0 right-0 h-12 w-12 bg-sky-800 rounded-full transform translate-x-4 -translate-y-4 opacity-0 group-hover:opacity-100 transition-opacity">
            <span class="text-white text-lg font-bold absolute top-3 left-3">4</span>
        </div>
    </div>
</div>


    </div>
</div>
</div>
@endsection
