@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8 max-w-4xl">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
            <i class="ri-psychotherapy-line mr-3 text-blue-600"></i>
            Add New Therapist
        </h1>

        <div class="mt-2 h-1 w-24 bg-blue-600 rounded"></div>

        <p class="mt-3 text-gray-600 dark:text-gray-400">
            Fill in therapist details including specialization, availability, and fees.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">

        <div class="p-6">

            <form action="{{ route('therapist.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Specialist -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Specialist <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-user-star-line text-gray-400"></i>
                        </div>

                        <select name="specialist_id"
                                required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            <option value="" disabled selected>Select Specialist</option>
                            @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    @error('specialist_id')
                        <p class="text-sm text-red-500 mt-2 flex items-center">
                            <i class="ri-error-warning-line mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Therapist Name <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-user-line text-gray-400"></i>
                        </div>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Enter therapist name"
                               required
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    @error('name')
                        <p class="text-sm text-red-500 mt-2 flex items-center">
                            <i class="ri-error-warning-line mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Photo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Photo <span class="text-red-500">*</span>
                    </label>

                    <input type="file"
                           name="photopath"
                           required
                           class="block w-full text-sm text-gray-700 dark:text-gray-300
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100">

                    @error('photopath')
                        <p class="text-sm text-red-500 mt-2 flex items-center">
                            <i class="ri-error-warning-line mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>

                    <textarea name="description"
                              rows="4"
                              placeholder="Write therapist description..."
                              required
                              class="block w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                     bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-sm text-red-500 mt-2 flex items-center">
                            <i class="ri-error-warning-line mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Location + Experience + Fee -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <input type="text"
                           name="location"
                           placeholder="Location"
                           value="{{ old('location') }}"
                           class="w-full px-3 py-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                    <input type="text"
                           name="experience"
                           placeholder="Experience"
                           value="{{ old('experience') }}"
                           class="w-full px-3 py-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                    <input type="number"
                           name="fee"
                           placeholder="Fee"
                           step="0.01"
                           value="{{ old('fee') }}"
                           class="w-full px-3 py-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                </div>

                <!-- Time Slots -->
                <div id="timeSlotsWrapper">
                    <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Available Time Slots
                    </label>

                    <div class="flex gap-3 mb-2">
                        <input type="time" name="available_time_slots[]" required
                               class="px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                        <button type="button"
                                id="addTimeSlotBtn"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            + Add
                        </button>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <select name="status"
                            class="w-full px-3 py-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                        <option value="Available">Available</option>
                        <option value="Not-Available">Not Available</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between pt-4 border-t border-gray-200 dark:border-gray-700">

                    <a href="{{ route('therapist.index') }}"
                       class="px-5 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-3 rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-500">
                        Save Therapist
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
    div.classList.add('flex', 'gap-3', 'mb-2');

    div.innerHTML = `
        <input type="time" name="available_time_slots[]" required
               class="px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">

        <button type="button"
                class="removeTimeSlotBtn bg-red-500 text-white px-3 py-2 rounded-lg">
            Remove
        </button>
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