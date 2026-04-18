@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title-wrap">
        <div class="page-label text-gray-500 dark:text-gray-400">Content</div>

        <h1 class="page-title text-gray-900 dark:text-gray-100">
            <i class="ri-mental-health-line"></i>
            Mindfulness Activities
        </h1>
    </div>

    <a href="{{ route('mindfulness_activities.create') }}" class="btn-primary">
        <i class="ri-add-line"></i>
        Add Activity
    </a>
</div>

@if(session('success'))
<div class="flash-msg flex items-center gap-2 text-gray-800 dark:text-gray-100">
    <i class="ri-check-circle-line text-green-500 text-lg"></i>
    {{ session('success') }}
</div>
@endif

<!-- TABLE -->
<div class="table-card bg-white dark:bg-gray-900">
    <div class="tbl-scroll">
        <table class="tbl w-full">

            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="w-12">#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="w-[200px]">Video</th>
                    <th>Category</th>
                    <th class="w-36">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($activities as $activity)
                <tr class="border-b border-gray-200 dark:border-gray-700">

                    <!-- INDEX -->
                    <td>
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold
                                     bg-blue-100 text-blue-600
                                     dark:bg-blue-900 dark:text-blue-300">
                            {{ $loop->iteration }}
                        </span>
                    </td>

                    <!-- TITLE -->
                    <td>
                        <p class="font-semibold text-sm text-gray-900 dark:text-gray-100">
                            {{ $activity->title }}
                        </p>
                    </td>

                    <!-- DESCRIPTION -->
                    <td>
                        <span class="text-xs text-gray-600 dark:text-gray-300">
                            {{ \Illuminate\Support\Str::limit($activity->description, 80) }}
                        </span>
                    </td>

                    <!-- VIDEO -->
                    <td>
                        <div class="relative pt-[56.25%] rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800">
                            <iframe
                                class="absolute inset-0 w-full h-full border-0"
                                src="{{ $activity->video_url }}"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </td>

                    <!-- CATEGORY -->
                    <td>
                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-xs font-semibold
                                     bg-green-50 text-green-600 border border-green-200
                                     dark:bg-green-900 dark:text-green-300 dark:border-green-700">
                            {{ $activity->category->name ?? 'N/A' }}
                        </span>
                    </td>

                    <!-- ACTIONS -->
                    <td>
                        <div class="flex gap-2">

                            <a href="{{ route('mindfulness_activities.edit', $activity->id) }}"
                               class="px-2 py-1 rounded-md text-xs font-semibold
                                      bg-blue-50 text-blue-600 border border-blue-200
                                      dark:bg-blue-900 dark:text-blue-300"><i class="ri-edit-line"></i>
                                Edit
                            </a>

                            <button type="button"
                                onclick="openDeleteModal('{{ route('mindfulness_activities.destroy', $activity->id) }}')"
                                class="px-2 py-1 rounded-md text-xs font-semibold
                                       bg-red-50 text-red-600 border border-red-200
                                       dark:bg-red-900 dark:text-red-300"><i class="ri-delete-bin-line"></i>
                                Delete
                            </button>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500">
                        No activities found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="popup"
     class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">

    <div class="bg-white dark:bg-gray-900 rounded-xl w-[90%] max-w-md p-6 text-center shadow-xl">

        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
            Delete Activity?
        </h3>

        <p class="text-sm text-gray-500 mb-5">
            This action cannot be undone.
        </p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">

                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg">
                    Cancel
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg">
                    Delete
                </button>

            </div>
        </form>

    </div>
</div>

<!-- JS -->
<script>
function openDeleteModal(actionUrl) {
    const popup = document.getElementById('popup');
    const form = document.getElementById('deleteForm');

    popup.classList.remove('hidden');
    popup.classList.add('flex');

    document.body.style.overflow = 'hidden';

    form.action = actionUrl;
}

function closeDeleteModal() {
    const popup = document.getElementById('popup');

    popup.classList.add('hidden');
    popup.classList.remove('flex');

    document.body.style.overflow = '';
}
</script>

@endsection