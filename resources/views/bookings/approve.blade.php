@extends('layouts.app')
@section('content')

<div class="page-header flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div class="page-title-wrap">
        <div class="page-label text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">
            Appointments
        </div>

        <h1 class="page-title text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <i class="ri-calendar-check-line text-blue-600"></i>
            Approval Queue
        </h1>
    </div>

    <a href="{{ route('bookings.history') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-semibold rounded-xl transition-all shadow-sm">
        <i class="ri-history-line"></i>
        View History
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

<div class="flex items-center gap-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 border-l-4 border-l-blue-500 rounded-xl p-4 mb-6 text-sm text-blue-800 dark:text-blue-300 shadow-sm">
    <i class="ri-information-fill text-lg shrink-0"></i>
    <p>Showing <strong>Pending</strong> and <strong>Processing</strong> appointments below. Use the action buttons to update their status and trigger email notifications.</p>
</div>

<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">

            <thead class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <tr class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    <th class="p-4 font-bold">Therapist</th>
                    <th class="p-4 font-bold">Patient</th>
                    <th class="p-4 font-bold">Contact</th>
                    <th class="p-4 font-bold">Date & Time</th>
                    <th class="p-4 font-bold">Fee</th>
                    <th class="p-4 font-bold">Message</th>
                    <th class="p-4 font-bold">Status</th>
                    <th class="p-4 font-bold w-48 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-800">

                @php $hasRows = false; @endphp

                @foreach ($bookings as $booking)
                @if($booking->status !== 'Approved' && $booking->status !== 'Rejected')

                @php $hasRows = true; @endphp

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

                    <td class="p-4 font-bold text-gray-900 dark:text-white">
                        {{ $booking->name }}
                    </td>

                    <td class="p-4">
                        <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-300 font-medium mb-1 text-xs">
                            <i class="ri-mail-line text-gray-400"></i> {{ $booking->email }}
                        </div>
                        <div class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 text-xs">
                            <i class="ri-phone-line text-gray-400"></i> {{ $booking->phone }}
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
                        <p class="text-xs text-gray-500 dark:text-gray-400 max-w-[140px] truncate" title="{{ $booking->message }}">
                            {{ $booking->message ?: '—' }}
                        </p>
                    </td>

                    <td class="p-4">
                        @php $s = strtolower($booking->status); @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border
                            {{ $s === 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-800' : '' }}
                            {{ $s === 'processing' ? 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $s === 'pending' ? 'bg-yellow-500' : 'bg-blue-500' }}"></span>
                            {{ $booking->status }}
                        </span>
                    </td>

                    <td class="p-4">
                        <div class="flex flex-col gap-1.5">

                            @if($booking->status === 'Pending')
                            <a href="{{ route('bookings.updateStatus', ['id' => $booking->id, 'status' => 'Processing']) }}"
                               class="flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-all
                                      bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600
                                      dark:bg-blue-900/30 dark:hover:bg-blue-600 dark:text-blue-400 dark:border-blue-800">
                                <i class="ri-loader-4-line"></i> Process
                            </a>
                            @endif

                            @if($booking->status === 'Processing')
                            <a href="{{ route('bookings.updateStatus', ['id' => $booking->id, 'status' => 'Pending']) }}"
                               class="flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-all
                                      bg-yellow-50 hover:bg-yellow-500 text-yellow-700 hover:text-white border border-yellow-200 hover:border-yellow-500
                                      dark:bg-yellow-900/30 dark:hover:bg-yellow-600 dark:text-yellow-400 dark:border-yellow-800">
                                <i class="ri-arrow-go-back-line"></i> Revert
                            </a>
                            @endif

                            <div class="grid grid-cols-2 gap-1.5 mt-0.5">
                                <a href="{{ route('bookings.updateStatus', ['id' => $booking->id, 'status' => 'Approved']) }}"
                                   class="flex items-center justify-center gap-1 px-2 py-1.5 rounded-lg text-xs font-bold transition-all
                                          bg-emerald-50 hover:bg-emerald-500 text-emerald-700 hover:text-white border border-emerald-200 hover:border-emerald-500
                                          dark:bg-emerald-900/30 dark:hover:bg-emerald-600 dark:text-emerald-400 dark:border-emerald-800"
                                   title="Approve">
                                    <i class="ri-check-line text-sm"></i>
                                </a>

                                <a href="{{ route('bookings.updateStatus', ['id' => $booking->id, 'status' => 'Rejected']) }}"
                                   class="flex items-center justify-center gap-1 px-2 py-1.5 rounded-lg text-xs font-bold transition-all
                                          bg-red-50 hover:bg-red-500 text-red-700 hover:text-white border border-red-200 hover:border-red-500
                                          dark:bg-red-900/30 dark:hover:bg-red-600 dark:text-red-400 dark:border-red-800"
                                   title="Reject">
                                    <i class="ri-close-line text-sm"></i>
                                </a>
                            </div>

                        </div>
                    </td>

                </tr>

                @endif
                @endforeach

                @if(!$hasRows)
                <tr>
                    <td colspan="8" class="p-10">
                        <div class="text-center max-w-sm mx-auto">
                            <div class="w-16 h-16 rounded-full bg-gray-50 dark:bg-gray-800 flex items-center justify-center mx-auto mb-4 border border-gray-100 dark:border-gray-700">
                                <i class="ri-check-double-line text-3xl text-emerald-400 dark:text-emerald-500"></i>
                            </div>
                            <p class="font-bold text-gray-900 dark:text-white text-lg mb-1">
                                You're all caught up!
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                There are no pending or processing appointments in the queue right now.
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