@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-8">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
            <i class="ri-brain-line mr-3 text-blue-600"></i>
            Add Mindfulness Activity
        </h1>

        <div class="mt-2 h-1 w-24 bg-blue-600 rounded"></div>

        <p class="mt-3 text-gray-600 dark:text-gray-400">
            Create a new mindfulness activity with video and category details.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">

            <form action="{{ route('mindfulness_activities.store') }}"
                  method="POST"
                  class="space-y-6">

                @csrf

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Activity Title
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-edit-2-line text-gray-400"></i>
                        </div>

                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="Enter activity title"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    </div>

                    @error('title')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description
                    </label>

                    <textarea name="description"
                              rows="5"
                              placeholder="Write activity description..."
                              class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                     bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video URL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        YouTube Video URL
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-youtube-line text-gray-400"></i>
                        </div>

                        <input type="url"
                               name="video_url"
                               value="{{ old('video_url') }}"
                               placeholder="https://youtube.com/..."
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500">
                    </div>

                    @error('video_url')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Category
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-folder-3-line text-gray-400"></i>
                        </div>

                        <select name="category_id"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                       focus:ring-2 focus:ring-blue-500">

                            <option value="" disabled selected>Select Category</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    @error('category_id')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-between pt-4 border-t border-gray-200 dark:border-gray-700">

                    <a href="{{ route('mindfulness_activities.index') }}"
                       class="px-5 py-3 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-3 rounded-lg bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold shadow-md">
                        Save Activity
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection