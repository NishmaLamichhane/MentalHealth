@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title-wrap">
        <div class="page-label text-gray-500 dark:text-gray-400">Content</div>

        <h1 class="page-title text-gray-900 dark:text-gray-100">
            <i class="ri-price-tag-3-line"></i>
            Categories
        </h1>
    </div>

    <a href="{{ route('category.create') }}" class="btn-primary">
        <i class="ri-add-line"></i>
        Add Category
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
                    <th class="w-16">Id</th>
                    <th>Category Name</th>
                    <th class="w-40">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $category)
                <tr class="border-b border-gray-200 dark:border-gray-700">

                    <!-- PRIORITY -->
                    <td>
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold
                                     bg-blue-100 text-blue-600
                                     dark:bg-blue-900 dark:text-blue-300">
                            {{ $category->priority }}
                        </span>
                    </td>

                    <!-- NAME -->
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center
                                        bg-gradient-to-br from-blue-100 to-indigo-100
                                        text-blue-600
                                        dark:from-blue-900 dark:to-indigo-900 dark:text-blue-300">
                                <i class="ri-price-tag-3-line"></i>
                            </div>

                            <span class="font-semibold text-sm text-gray-900 dark:text-gray-100">
                                {{ $category->name }}
                            </span>
                        </div>
                    </td>

                    <!-- ACTIONS -->
                    <td>
                        <div class="flex gap-2">

                            <a href="{{ route('category.edit', $category->id) }}"
                               class="px-2 py-1 rounded-md text-xs font-semibold
                                      bg-blue-50 text-blue-600 border border-blue-200
                                      dark:bg-blue-900 dark:text-blue-300">
                                <i class="ri-edit-line"></i> Edit
                            </a>

                            <button type="button"
                                onclick="openDeleteModal('{{ route('category.destroy', $category->id) }}')"
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
                    <td colspan="3" class="text-center py-10 text-gray-500">
                        No categories found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

<!-- DELETE MODAL (FIXED) -->
<div id="popup"
     class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">

    <div class="bg-white dark:bg-gray-900 rounded-xl w-[90%] max-w-md shadow-xl p-6 text-center">

        <h3 class="text-lg font-bold mb-2 text-gray-900 dark:text-white">
            Delete Category?
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
                    class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700">
                    Cancel
                </button>

                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-red-600 text-white">
                    Delete
                </button>

            </div>
        </form>

    </div>
</div>

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