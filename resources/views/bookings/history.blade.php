@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title-wrap">
        <div class="page-label text-gray-500 dark:text-gray-400">
            Appointments
        </div>

        <h1 class="page-title text-gray-900 dark:text-white">
            <i class="ri-psychotherapy-line"></i>
            Appointment History
        </h1>
    </div>

    <a href="{{ route('bookings.approve') }}" class="btn-secondary">
        <i class="ri-arrow-left-line"></i>
        Go Back
    </a>
</div>

@if(session('success'))
<div class="flash-msg flex items-center gap-2">
    <i class="ri-check-circle-line text-green-500 text-lg"></i>
    <span class="text-gray-700 dark:text-gray-200">
        {{ session('success') }}
    </span>
</div>
@endif

<!-- Table Card -->
<div class="table-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">

    <div class="tbl-scroll">
        <table class="tbl w-full">

            <!-- Header -->
            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                <tr class="text-sm">
                    <th>Therapist</th>
                    <th>Patient</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Fee</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="text-sm">

                @forelse ($bookings as $booking)
                <tr class="border-b border-gray-100 dark:border-gray-700">

                    <!-- Therapist -->
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-indigo-600 dark:text-indigo-300 text-xs font-bold">
                                {{ Str::substr($booking->therapist->name ?? 'T', 0, 1) }}
                            </div>
                            <span class="font-semibold text-gray-900 dark:text-white">
                                {{ $booking->therapist->name }}
                            </span>
                        </div>
                    </td>

                    <!-- Patient -->
                    <td class="font-semibold text-gray-900 dark:text-white">
                        {{ $booking->name }}
                    </td>

                    <!-- Email -->
                    <td class="text-xs text-gray-600 dark:text-gray-300">
                        {{ $booking->email }}
                    </td>

                    <!-- Phone -->
                    <td class="text-xs text-gray-600 dark:text-gray-300">
                        {{ $booking->phone }}
                    </td>

                    <!-- Date -->
                    <td class="font-semibold text-gray-900 dark:text-white">
                        {{ $booking->booking_date }}
                    </td>

                    <!-- Time -->
                    <td class="text-gray-600 dark:text-gray-300">
                        {{ $booking->booking_time }}
                    </td>

                    <!-- Fee -->
                    <td>
                        <span class="font-bold text-gray-900 dark:text-white">
                            Rs. {{ $booking->therapist->fee }}
                        </span>
                    </td>

                    <!-- Message -->
                    <td>
                        <p class="text-xs text-gray-500 dark:text-gray-300 max-w-[160px] truncate">
                            {{ $booking->message ?: '—' }}
                        </p>
                    </td>

                    <!-- Status -->
                    <td>
                        @php $s = strtolower($booking->status); @endphp
                        <span class="badge badge-{{ $s }}">
                            <span class="badge-dot"></span>
                            {{ $booking->status }}
                        </span>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="9">
                        <div class="text-center py-10">

                            <i class="ri-calendar-check-line text-4xl text-gray-300 dark:text-gray-600 mb-2"></i>

                            <p class="font-semibold text-gray-600 dark:text-gray-300">
                                No appointment history found
                            </p>

                            <p class="text-sm text-gray-400 dark:text-gray-500">
                                Completed appointments will appear here
                            </p>

                        </div>
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>
</div>

@endsection