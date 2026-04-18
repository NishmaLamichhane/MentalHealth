@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title-wrap">
        <div class="page-label text-gray-500 dark:text-gray-400">Management</div>

        <h1 class="page-title text-gray-900 dark:text-white">
            <i class="ri-user-star-line"></i>
            Specialists
        </h1>
    </div>

    <a href="{{ route('specialist.create') }}" class="btn-primary">
        <i class="ri-add-line"></i>
        Add Specialist
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
                    <th class="w-16">#</th>
                    <th>Specialist Name</th>
                    <th class="w-40">Actions</th>
                </tr>
            </thead>

            <tbody class="text-sm">

                @forelse($specialists as $specialist)
                <tr class="border-b border-gray-100 dark:border-gray-700">

                    <td>
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 text-xs font-bold">
                            {{ $specialist->priority }}
                        </span>
                    </td>

                    <td>
                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900 dark:to-indigo-900 flex items-center justify-center text-indigo-600 dark:text-indigo-300 font-bold text-sm">
                                {{ Str::substr($specialist->name, 0, 1) }}
                            </div>

                            <span class="font-semibold text-gray-900 dark:text-white">
                                {{ $specialist->name }}
                            </span>
                        </div>
                    </td>

                    <td>
                        <div class="flex gap-2">

                            <a href="{{ route('specialist.edit', $specialist->id) }}"
                               class="px-2 py-1 rounded-md text-xs font-semibold
                                      bg-blue-50 text-blue-600 border border-blue-200
                                      dark:bg-blue-900 dark:text-blue-300">
                                <i class="ri-edit-line"></i> Edit
                            </a>

                            <button type="button"
                                onclick="openDeleteModal('{{ route('specialist.destroy', $specialist->id) }}')"
                                class="px-2 py-1 rounded-md text-xs font-semibold
                                       bg-red-50 text-red-600 border border-red-200
                                       dark:bg-red-900 dark:text-red-300">
                                <i class="ri-delete-bin-line"></i> Delete
                            </button>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-10">
                        No specialists found
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

    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl w-[90%] max-w-md text-center shadow-xl">

        <h3 class="text-lg font-bold mb-2 text-gray-900 dark:text-white">
            Delete Specialist?
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
    document.getElementById('popup').classList.remove('hidden');
    document.getElementById('popup').classList.add('flex');

    document.getElementById('deleteForm').action = actionUrl;
}

function closeDeleteModal() {
    document.getElementById('popup').classList.add('hidden');
    document.getElementById('popup').classList.remove('flex');
}
</script>

@endsection