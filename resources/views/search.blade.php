@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-blue-900 border-l-4 border-blue-900 pl-4">Search Results</h1>
        <p class="mt-2 text-gray-600">Explore the therapists and mindfulness activities related to your search.</p>
    </div>

    @php
        $hasResults = $therapists->isNotEmpty() || $activities->isNotEmpty() || $specialists->isNotEmpty();
    @endphp

    @if($hasResults)
        <div class="mt-10">
            <h2 class="text-3xl font-bold text-blue-900 mb-4">Therapists</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($therapists as $therapist)
                    <a href="{{ route('viewtherapist', $therapist->id) }}" class="group">
                        <div class="border rounded-lg bg-white shadow-lg transition-transform transform group-hover:-translate-y-2 duration-300 overflow-hidden hover:shadow-xl">
                            <img src="{{ asset('images/therapists/' . $therapist->photopath) }}" alt="{{ $therapist->name }}" class="h-64 w-full object-cover">
                            <div class="p-6">
                                <h2 class="text-xl font-bold text-blue-900 mb-2">{{ $therapist->name }}</h2>
                                <p class="text-gray-700 mb-4">{{ Str::limit($therapist->description, 120) }}</p>
                                <a href="{{ route('viewtherapist', $therapist->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md transition duration-300 hover:bg-blue-700 hover:shadow-lg">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </a>
                @empty
                    {{-- This block will not be reached since we check hasResults above --}}
                @endforelse
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-3xl font-bold text-blue-900 mb-4">Mindfulness Activities</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse($activities as $activity)
                    <div>
                        <h3 class=" text-sm text-gray-500">{{ $activity->title }} video is available yahuuu!!😊Watch Now!!</h3>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative" style="padding-top: 56.25%;">
                                <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $activity->video_url }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-blue-900">{{ $activity->title }}</h3>
                                <p class="text-gray-700 mt-2">{{ Str::limit($activity->description, 100) }}</p>
                            </div>
                            <div class="text-center pb-4">
                                <a href="{{ $activity->video_url }}" target="_blank" class="inline-block bg-blue-900 text-white font-semibold py-2 px-4 rounded-md transition-colors duration-300 hover:bg-blue-700">
                                    Watch More
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- This block will not be reached since we check hasResults above --}}
                @endforelse
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-3xl font-bold text-blue-900 mb-4">Specialists</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($specialists as $specialist)
                    <a href="{{ route('specialisttherapist', $specialist->id) }}" class="block border rounded-lg p-4 bg-gray-100 hover:bg-blue-100 transition-colors duration-300">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $specialist->name }} Specialist therapist is available😊Explore it!!</h3>
                    </a>
                @empty
                    {{-- This block will not be reached since we check hasResults above --}}
                @endforelse
            </div>
        </div>
    @else
    <div class="flex flex-col items-center justify-center p-6 bg-gray-100 border border-gray-300 rounded-lg shadow-lg">
    <div class="flex items-center justify-center w-full mb-4">
        <img src="{{ asset('image/sad.png') }}" alt="Not Available" class="h-32 w-auto max-w-full">
    </div>
    <p class="text-gray-600 text-center">No results found related to your search.<br>Please try exploring other options or check back later.</p>
</div>

    @endif
</div>
@endsection
