@extends('layouts.master')

@section('content')
{{-- Therapist Profile Section --}}
<div class="bg-gradient-to-b from-blue-50 to-blue-100 py-12">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="grid lg:grid-cols-3 gap-12 items-center">
            {{-- Therapist Information --}}
            <div class="col-span-2 bg-white rounded-3xl shadow-xl p-10 flex flex-col">
                {{-- Therapist Name --}}
                <h1 class="text-4xl font-extrabold text-gray-800 mb-6">{{ $therapist->name }}</h1>

                {{-- About Section --}}
                <div class="space-y-8">
                    {{-- Description --}}
                    <div>
                        <h2 class="text-2xl font-semibold text-blue-700">About Therapist</h2>
                        <p class="text-gray-600 text-lg mt-3 leading-relaxed">{{ $therapist->description }}</p>
                    </div>

                    {{-- Experience --}}
                    <div>
                        <h2 class="text-2xl font-semibold text-blue-700">Experience</h2>
                        <p class="text-gray-600 text-lg mt-3 leading-relaxed">{{ $therapist->experience }}</p>
                    </div>

                    {{-- Fee --}}
                    <div>
                        <h2 class="text-2xl font-semibold text-blue-700">Therapist Fee</h2>
                        <p class="text-gray-600 text-lg mt-3 leading-relaxed">{{ $therapist->fee }}</p>
                    </div>

                    {{-- Location --}}
                    <div>
                        <h2 class="text-2xl font-semibold text-blue-700">Physically Available Location</h2>
                        <p class="text-gray-600 text-lg mt-3 leading-relaxed">{{ $therapist->location }}</p>
                    </div>
                </div>

                {{-- Appointment Button --}}
                <div class="mt-10 text-center">
                    <a href="{{ route('bookings.create', $therapist->id) }}"
                       class="inline-block bg-gradient-to-r from-sky-500 to-sky-700 text-white text-lg font-bold py-4 px-8 rounded-full shadow-lg hover:shadow-xl hover:from-sky-600 hover:to-sky-800 transition-all duration-300">
                        Book Appointment
                    </a>
                </div>
            </div>

            {{-- Therapist Photo --}}
            <div class="col-span-1 flex justify-center">
                <div class="relative group">
                    <img src="{{ asset('images/therapists/' . $therapist->photopath) }}"
                         alt="{{ $therapist->name }}"
                         class="w-full h-auto max-w-xs rounded-3xl shadow-lg group-hover:shadow-xl transition-all duration-500 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 rounded-3xl transition-opacity duration-500"></div>
                </div>
            </div>
        </div>

        {{-- Quote Section --}}
        <div class="bg-blue-200 border-l-4 border-blue-700 rounded-3xl p-8 mt-16 shadow-md text-center">
            <h2 class="text-2xl font-bold text-purple-900 underline">Contact Dr. {{ $therapist->name }}</h2>
            <p class="text-lg font-medium text-gray-800 mt-4">
                Thank you for considering Dr. {{ $therapist->name }} for your mental health needs. Feel free to reach out for any inquiries or to schedule an appointment.
            </p>
            <blockquote class="italic text-lg text-blue-900 mt-6 font-semibold">
                “Mental health is not a destination but a process. It’s about how you drive, not where you’re going.” <br>“Be kind to your mind.”
            </blockquote>
        </div>
    </div>
</div>

{{-- Related Therapists Section --}}
<div class="bg-white py-16">
    <div class="container mx-auto px-6 lg:px-16">
        <h2 class="text-3xl font-bold text-gray-800 border-l-4 border-blue-700 pl-4 mb-8">Related Therapists</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedtherapists as $rtherapist)
            <a href="{{ route('viewtherapist', $rtherapist->id) }}"
               class="block group bg-gray-100 rounded-3xl shadow-lg hover:shadow-xl transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('images/therapists/' . $rtherapist->photopath) }}"
                     alt="{{ $rtherapist->name }}"
                     class="w-full h-56 rounded-t-3xl object-cover">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-700">{{ $rtherapist->name }}</h3>
                    <p class="text-gray-600 text-sm mt-2">{{ Str::limit($rtherapist->description, 100) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
