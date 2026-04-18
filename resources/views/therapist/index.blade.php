@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title-wrap">
        <div class="page-label text-gray-500 dark:text-gray-400">Management</div>

        <h1 class="page-title text-gray-900 dark:text-white">
            <i class="ri-psychotherapy-line"></i>
            Therapists
        </h1>
    </div>

    <a href="{{ route('therapist.create') }}" class="btn-primary">
        <i class="ri-add-line"></i>
        Add Therapist
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

<!-- TABLE -->
<div class="table-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
    <div class="tbl-scroll">
        <table class="tbl w-full">

            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr class="text-gray-600 dark:text-gray-300 text-sm">
                    <th class="w-12">Id</th>
                    <th>Therapist</th>
                    <th>Specialization</th>
                    <th>Location</th>
                    <th>Experience</th>
                    <th class="w-24">Fee</th>
                    <th>Status</th>
                    <th class="w-40">Actions</th>
                </tr>
            </thead>

            <tbody class="text-sm">

                @forelse($therapists as $therapist)
                <tr class="border-b border-gray-100 dark:border-gray-700">

                    <td>
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 text-xs font-bold">
                            {{ $loop->iteration }}
                        </span>
                    </td>

                    <td>
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('images/therapists/' . $therapist->photopath) }}"
                                 class="w-10 h-10 rounded-lg object-cover border">

                            <div>
                                <p class="font-semibold text-gray-900 dark:text-white text-sm">
                                    {{ $therapist->name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ Str::limit($therapist->description, 60) }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span class="px-2 py-1 rounded-md text-xs font-semibold bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                            {{ $therapist->specialist->name ?? '—' }}
                        </span>
                    </td>

                    <td class="text-gray-600 dark:text-gray-300">
                        {{ $therapist->location }}
                    </td>

                    <td class="text-gray-600 dark:text-gray-300">
                        {{ $therapist->experience }}
                    </td>

                    <td>
                        <span class="font-bold text-gray-900 dark:text-white">
                            Rs. {{ $therapist->fee }}
                        </span>
                    </td>

                    <td>
                        @if($therapist->status === 'Available')
                            <span class="badge badge-approved">
                                <span class="badge-dot"></span> Active
                            </span>
                        @else
                            <span class="badge badge-inactive">
                                <span class="badge-dot bg-gray-400"></span>
                                {{ $therapist->status }}
                            </span>
                        @endif
                    </td>

                    <td>
                        <div class="flex gap-2">

                            <a href="{{ route('therapist.edit', $therapist->id) }}"
                               class="act-edit">
                                <i class="ri-edit-line"></i> Edit
                            </a>

                            <button type="button"
                                    onclick="showPopup({{ $therapist->id }})"
                                    class="act-delete">
                                <i class="ri-delete-bin-line"></i> Delete
                            </button>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-10 text-gray-500">
                        No therapists found
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>
</div>

<!-- DELETE MODAL (FIXED OVERLAY) -->
<div id="popup"
     class="fixed inset-0 hidden z-[9999] bg-black/50 flex items-center justify-center"
     onclick="if(event.target===this)hidePopup()">

    <div class="bg-white dark:bg-gray-900 rounded-xl p-6 w-[90%] max-w-md text-center shadow-lg">

        <h2 class="text-lg font-bold mb-4">Delete Therapist?</h2>
        <p class="text-sm text-gray-500 mb-6">This action cannot be undone.</p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">

                <button type="button"
                        onclick="hidePopup()"
                        class="px-4 py-2 bg-gray-200 rounded">
                    Cancel
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded">
                    Delete
                </button>

            </div>
        </form>

    </div>
</div>

<script>
function showPopup(id) {
    const popup = document.getElementById('popup');
    const form = document.getElementById('deleteForm');

    popup.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    let url = "{{ route('therapist.destroy', ':id') }}";
    form.action = url.replace(':id', id);
}

function hidePopup() {
    document.getElementById('popup').classList.add('hidden');
    document.body.style.overflow = '';
}
</script>

@endsection