@extends('layouts.app')
@section('content')

<div class="page-header flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div class="page-title-wrap">
        <div class="page-label text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">
            Appointments
        </div>

        <h1 class="page-title text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <i class="ri-history-line text-blue-600"></i>
            Appointment History
        </h1>
    </div>

    <a href="{{ route('bookings.approve') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-semibold rounded-xl transition-all shadow-sm">
        <i class="ri-arrow-left-line"></i>
        Back to Queue
    </a>
</div>

@if(session('success'))
<div class="flash-msg flex items-center gap-3 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 p-4 rounded-xl mb-6 shadow-sm">
    <i class="ri-check-circle-fill text-emerald-500 text-xl"></i>
    <span class="text-sm font-semibold text-emerald-800 dark:text-emerald-300">
        {{ session('success') }}
    </span>
</div>
@endif

<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">

            <thead class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <tr class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    <th class="p-4 font-bold">Therapist</th>
                    <th class="p-4 font-bold">Patient & Contact</th>
                    <th class="p-4 font-bold">Date & Time</th>
                    <th class="p-4 font-bold">Fee</th>
                    <th class="p-4 font-bold">Message</th>
                    <th class="p-4 font-bold">Status</th>
                </tr>
            </thead>

            <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-800">

                @forelse ($bookings as $booking)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">

                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-sm font-bold shrink-0">
                                {{ Str::substr($booking->therapist->name ?? 'T', 0, 1) }}
                            </div>
                            <span class="font-bold text-gray-900 dark:text-white">
                                {{ $booking->therapist->name }}
                            </span>
                        </div>
                    </td>

                    <td class="p-4">
                        <div class="font-bold text-gray-900 dark:text-white mb-1">
                            {{ $booking->name }}
                        </div>
                        <div class="flex flex-col gap-0.5 text-xs">
                            <span class="flex items-center gap-1.5 text-gray-600 dark:text-gray-300">
                                <i class="ri-mail-line text-gray-400"></i> {{ $booking->email }}
                            </span>
                            <span class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400">
                                <i class="ri-phone-line text-gray-400"></i> {{ $booking->phone }}
                            </span>
                        </div>
                    </td>

                    <td class="p-4">
                        <p class="font-bold text-gray-900 dark:text-white mb-0.5">
                            {{ $booking->booking_date }}
                        </p>
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 inline-block px-2 py-0.5 rounded-md">
                            {{ $booking->booking_time }}
                        </p>
                    </td>

                    <td class="p-4">
                        <span class="font-bold text-gray-900 dark:text-white">
                            Rs. {{ $booking->therapist->fee }}
                        </span>
                    </td>

                    <td class="p-4">
                        <p class="text-xs text-gray-500 dark:text-gray-400 max-w-[160px] truncate" title="{{ $booking->message }}">
                            {{ $booking->message ?: '—' }}
                        </p>
                    </td>

                    <td class="p-4">
                        @php $s = strtolower($booking->status); @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border
                            {{ $s === 'approved' ? 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-400 dark:border-emerald-800' : '' }}
                            {{ $s === 'rejected' ? 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $s === 'approved' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                            {{ $booking->status }}
                        </span>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="p-10">
                        <div class="text-center max-w-sm mx-auto">
                            <div class="w-16 h-16 rounded-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center mx-auto mb-4 border border-gray-100 dark:border-gray-700">
                                <i class="ri-history-line text-3xl text-gray-400 dark:text-gray-500"></i>
                            </div>
                            <p class="font-bold text-gray-900 dark:text-white text-lg mb-1">
                                No History Yet
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Processed appointments (Approved or Rejected) will appear here for your records.
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