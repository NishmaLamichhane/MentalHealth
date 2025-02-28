@extends('layouts.master')

@section('content')
<div class="px-16 py-8">
    <div class="border-l-4 border-blue-900 pl-2 mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $specialists->name }} Therapists</h1>
        <p class="text-lg text-gray-600">{{ $specialists->name }} Specialists</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($therapists as $therapist)
        <a href="{{ route('viewtherapist', $therapist->id) }}" class="block">
            <div class="border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 bg-white">
                <img src="{{ asset('images/therapists/' . $therapist->photopath) }}" alt="{{ $therapist->name }}" class="h-48 w-full object-cover rounded-t-lg">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-blue-900">{{ $therapist->name }}</h2>
                    <p class="text-gray-700 mt-1">Fee: Rs. {{ $therapist->fee }}</p>
                    <p class="text-gray-600 mt-2">{{ Str::limit($therapist->description, 80) }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $therapists->links() }}
    </div>
</div>
@endsection
