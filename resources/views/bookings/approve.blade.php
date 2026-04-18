@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title-wrap">
        <div class="page-label text-gray-500 dark:text-gray-400">
            Appointments
        </div>

        <h1 class="page-title text-gray-900 dark:text-white">
            <i class="ri-calendar-check-line"></i>
            Approval Queue
        </h1>
    </div>

    <a href="{{ route('bookings.history') }}" class="btn-secondary">
        <i class="ri-history-line"></i>
        View History
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

<!-- Info banner -->
<div style="display:flex; align-items:center; gap:0.65rem; background:#eff6ff; border:1px solid #bfdbfe; border-left:4px solid #3b82f6; border-radius:0.75rem; padding:0.85rem 1.1rem; margin-bottom:1.5rem; font-size:0.83rem; color:#1d4ed8;">
    <i class="ri-information-line" style="font-size:1rem; flex-shrink:0;"></i>
    Showing only <strong>Pending</strong> appointments below. Use the action buttons to update their status.
</div>

<!-- Table Card -->
<div class="table-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">

    <div class="tbl-scroll">
        <table class="tbl w-full">

            <!-- Header -->
            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                <tr class="text-sm">
                    <th>Therapist</th>
                    <th>Patient</th>
                    <th>Contact</th>
                    <th>Date & Time</th>
                    <th>Fee</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th class="w-48">Actions</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="text-sm">

                @php $hasRows = false; @endphp

                @foreach ($bookings as $booking)
                @if($booking->status !== 'Approved' && $booking->status !== 'Rejected')

                @php $hasRows = true; @endphp

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

                    <!-- Contact -->
                    <td>
                        <p class="text-xs text-gray-600 dark:text-gray-300">
                            {{ $booking->email }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-400">
                            {{ $booking->phone }}
                        </p>
                    </td>

                    <!-- Date -->
                    <td>
                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ $booking->booking_date }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-400">
                            {{ $booking->booking_time }}
                        </p>
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

                    <!-- Actions -->
                    <td>
                        <div class="flex flex-col gap-1">

                            <a href="{{ route('bookings.updateStatus', ['id' => $booking->id, 'status' => 'Pending']) }}"
                               class="flex items-center gap-1 px-2 py-1 rounded-md text-xs font-bold
                                      bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 hover:opacity-80">
                                <i class="ri-time-line"></i> Pending
                            </a>

                            <a href="{{ route('bookings.updateStatus', ['id' => $booking->id, 'status' => 'Approved']) }}"
                               class="flex items-center gap-1 px-2 py-1 rounded-md text-xs font-bold
                                      bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 hover:opacity-80">
                                <i class="ri-check-line"></i> Approve
                            </a>

                            <a href="{{ route('bookings.updateStatus', ['id' => $booking->id, 'status' => 'Rejected']) }}"
                               class="flex items-center gap-1 px-2 py-1 rounded-md text-xs font-bold
                                      bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 hover:opacity-80">
                                <i class="ri-close-line"></i> Reject
                            </a>

                        </div>
                    </td>

                </tr>

                @endif
                @endforeach

                <!-- Empty State -->
                @if(!$hasRows)
                <tr>
                    <td colspan="8">
                        <div class="text-center py-10">

                            <i class="ri-calendar-check-line text-4xl text-gray-300 dark:text-gray-600 mb-2"></i>

                            <p class="font-semibold text-gray-600 dark:text-gray-300">
                                No pending appointments
                            </p>

                            <p class="text-sm text-gray-400 dark:text-gray-500">
                                All appointments have been processed
                            </p>

                        </div>
                    </td>
                </tr>
                @endif

            </tbody>

        </table>
    </div>
</div>

@endsection
