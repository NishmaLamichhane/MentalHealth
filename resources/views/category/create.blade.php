@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-4 py-8">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
            <i class="ri-folder-add-line mr-3 text-blue-600"></i>
            Add Category
        </h1>

        <div class="mt-2 h-1 w-24 bg-blue-600 rounded"></div>

        <p class="mt-3 text-gray-600 dark:text-gray-400">
            Create a new category for organizing activities and content.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">

            <form action="{{ route('category.store') }}"
                  method="POST"
                  class="space-y-6">

                @csrf

                <!-- Priority -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Priority
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-bar-chart-2-line text-gray-400"></i>
                        </div>

                        <input type="number"
                               name="priority"
                               value="{{ old('priority') }}"
                               placeholder="Enter priority (e.g. 1, 2, 3)"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    @error('priority')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Category Name
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-folder-3-line text-gray-400"></i>
                        </div>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Enter category name"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-between pt-4 border-t border-gray-200 dark:border-gray-700">

                    <a href="{{ route('category.index') }}"
                       class="px-5 py-3 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-3 rounded-lg bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold shadow-md">
                        Save Category
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection