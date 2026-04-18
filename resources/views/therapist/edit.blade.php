@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-8">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
            <i class="ri-user-settings-line mr-3 text-blue-600"></i>
            Edit Therapist
        </h1>
        <div class="mt-2 h-1 w-24 bg-blue-600 rounded"></div>
        <p class="mt-3 text-gray-600 dark:text-gray-400">
            Update therapist details, availability, and professional information.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">

            <form action="{{ route('therapist.update', $therapist->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Specialist -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Specialist
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-stethoscope-line text-gray-400"></i>
                        </div>

                        <select name="specialist_id"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}"
                                    {{ $therapist->specialist_id == $specialist->id ? 'selected' : '' }}>
                                    {{ $specialist->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Therapist Name
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-user-line text-gray-400"></i>
                        </div>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $therapist->name) }}"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Profile Photo
                    </label>

                    <div class="relative">
                        <input type="file"
                               name="photopath"
                               class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg p-3
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>

                    @error('photopath')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description
                    </label>

                    <textarea name="description"
                              rows="4"
                              class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                     bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $therapist->description) }}</textarea>

                    @error('description')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location + Experience -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Location
                        </label>

                        <input type="text"
                               name="location"
                               value="{{ old('location', $therapist->location) }}"
                               class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Experience -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Experience
                        </label>

                        <input type="text"
                               name="experience"
                               value="{{ old('experience', $therapist->experience) }}"
                               class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status
                    </label>

                    <select name="status"
                            class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                   bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                   focus:ring-2 focus:ring-blue-500">

                        <option value="Available" {{ $therapist->status == 'Available' ? 'selected' : '' }}>
                            Available
                        </option>

                        <option value="Not-Available" {{ $therapist->status == 'Not-Available' ? 'selected' : '' }}>
                            Not Available
                        </option>
                    </select>
                </div>

                <!-- Time Slots -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                        Available Time Slots
                    </label>

                    <div id="timeSlotsWrapper" class="space-y-2">

                        @php
                            $times = old('available_time_slots', $therapist->time_slots ? explode(',', $therapist->time_slots) : []);
                        @endphp

                        @foreach($times as $time)
                        <div class="flex gap-2 items-center">
                            <input type="time"
                                   name="available_time_slots[]"
                                   value="{{ $time }}"
                                   class="p-2 border rounded-lg w-40 dark:bg-gray-700 dark:border-gray-600">

                            <button type="button"
                                    class="removeTimeSlotBtn px-3 py-2 rounded-lg bg-red-100 text-red-600 text-sm">
                                Remove
                            </button>
                        </div>
                        @endforeach

                    </div>

                    <button type="button"
                            id="addTimeSlotBtn"
                            class="mt-3 px-4 py-2 rounded-lg bg-blue-100 text-blue-700 text-sm font-semibold">
                        + Add Time Slot
                    </button>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between pt-4 border-t border-gray-200 dark:border-gray-700">

                    <a href="{{ route('therapist.index') }}"
                       class="px-5 py-3 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-3 rounded-lg bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold shadow-md">
                        Update Therapist
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- JS -->
<script>
document.getElementById('addTimeSlotBtn').addEventListener('click', function () {
    const wrapper = document.getElementById('timeSlotsWrapper');

    const div = document.createElement('div');
    div.classList.add('flex', 'gap-2', 'items-center');
    div.innerHTML = `
        <input type="time" name="available_time_slots[]" class="p-2 border rounded-lg w-40 dark:bg-gray-700 dark:border-gray-600">
        <button type="button" class="removeTimeSlotBtn px-3 py-2 rounded-lg bg-red-100 text-red-600 text-sm">Remove</button>
    `;

    wrapper.appendChild(div);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('removeTimeSlotBtn')) {
        e.target.parentElement.remove();
    }
});
</script>

@endsection