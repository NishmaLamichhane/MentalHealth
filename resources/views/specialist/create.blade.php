@extends('layouts.app')
@section('content')

<div class="container mx-auto px-4 py-8 max-w-3xl">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
            <i class="ri-user-star-line mr-3 text-blue-600"></i>
            Add New Specialist
        </h1>

        <div class="mt-2 h-1 w-24 bg-blue-600 rounded"></div>

        <p class="mt-3 text-gray-600 dark:text-gray-400">
            Create a new specialist category for therapists or services.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">

        <div class="p-6">

            <form action="{{ route('specialist.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Specialist Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Specialist Name <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-user-star-line text-gray-400"></i>
                        </div>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Enter specialist name (e.g. Psychologist)"
                               required
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                            <i class="ri-error-warning-line mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-between pt-4 border-t border-gray-200 dark:border-gray-700">

                    <a href="{{ route('specialist.index') }}"
                       class="inline-flex items-center px-5 py-3 rounded-lg border border-gray-300 dark:border-gray-600
                              text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700
                              hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                        <i class="ri-arrow-go-back-line mr-2"></i>
                        Cancel
                    </a>

                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 rounded-lg text-white
                                   bg-gradient-to-r from-blue-600 to-blue-500
                                   hover:from-blue-700 hover:to-blue-600
                                   shadow-md hover:shadow-lg transition">
                        <i class="ri-save-line mr-2"></i>
                        Save Specialist
                    </button>

                </div>

            </form>

        </div>
    </div>

    <!-- Info Box -->
    <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800/30 rounded-lg p-4">
        <div class="flex gap-3">
            <i class="ri-information-line text-blue-600 dark:text-blue-400 text-xl"></i>

            <div>
                <h3 class="text-sm font-semibold text-blue-800 dark:text-blue-300">
                    Specialist Guidelines
                </h3>
                <p class="text-sm text-blue-700 dark:text-blue-400 mt-1">
                    Add clear and meaningful specialist names. These will be used to categorize therapists and services in your system.
                </p>
            </div>
        </div>
    </div>

</div>

@endsection