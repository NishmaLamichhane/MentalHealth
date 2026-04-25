@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8 max-w-4xl">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
            <i class="ri-psychotherapy-line mr-3 text-blue-600"></i>
            Add New Therapist
        </h1>

        <div class="mt-2 h-1 w-24 bg-blue-600 rounded"></div>

        <p class="mt-3 text-gray-600 dark:text-gray-400">
            Fill in therapist details including specialization, dynamic availability, and fees.
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
            <div class="flex items-center mb-2">
                <i class="ri-error-warning-fill text-red-500 mr-2"></i>
                <span class="font-bold text-red-700">Please fix the following errors:</span>
            </div>
            <ul class="list-disc pl-5 text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">

        <div class="p-6">

            <form action="{{ route('therapist.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

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
                                <option value="{{ $specialist->id }}" {{ old('specialist_id') == $specialist->id ? 'selected' : '' }}>
                                    {{ $specialist->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>

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
                </div>

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
                </div>

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
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Location <span class="text-red-500">*</span></label>
                        <input type="text" name="location" placeholder="e.g. Kathmandu" value="{{ old('location') }}" required
                               class="w-full px-3 py-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Experience <span class="text-red-500">*</span></label>
                        <input type="text" name="experience" placeholder="e.g. 5 Years" value="{{ old('experience') }}" required
                               class="w-full px-3 py-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Fee (Rs.) <span class="text-red-500">*</span></label>
                        <input type="number" name="fee" placeholder="1500" step="0.01" value="{{ old('fee') }}" required
                               class="w-full px-3 py-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Working Schedule</h3>
                            <p class="text-sm text-gray-500">Define the days and times this therapist is available.</p>
                        </div>
                        <button type="button" id="addScheduleBtn" class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-4 py-2 rounded-lg text-sm font-bold flex items-center transition-colors">
                            <i class="ri-add-line mr-1"></i> Add Day
                        </button>
                    </div>

                    <div id="schedulesWrapper" class="space-y-4">
                        <div class="schedule-row bg-gray-50 dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 relative grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Day</label>
                                <select name="schedules[0][day_of_week]" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Start Time</label>
                                <input type="time" name="schedules[0][start_time]" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">End Time</label>
                                <input type="time" name="schedules[0][end_time]" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div class="flex gap-3 items-end">
                                <div class="flex-grow">
                                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Session (Mins)</label>
                                    <input type="number" name="schedules[0][session_duration]" value="60" min="15" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Profile Status
                    </label>
                    <select name="status" class="w-full px-3 py-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500" required>
                        <option value="Available">Available (Active)</option>
                        <option value="Not-Available">Not Available (Hidden)</option>
                    </select>
                </div>

                <div class="flex justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('therapist.index') }}" class="px-5 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        Cancel
                    </a>

                    <button type="submit" class="px-6 py-3 rounded-lg text-white font-bold bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                        <i class="ri-save-line mr-1"></i> Save Therapist
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    // Keep track of index to ensure unique names for the array
    let scheduleIndex = 1; 

    document.getElementById('addScheduleBtn').addEventListener('click', function () {
        const wrapper = document.getElementById('schedulesWrapper');

        const div = document.createElement('div');
        div.classList.add('schedule-row', 'bg-gray-50', 'dark:bg-gray-800', 'p-4', 'rounded-xl', 'border', 'border-gray-200', 'dark:border-gray-700', 'grid', 'grid-cols-1', 'md:grid-cols-4', 'gap-4', 'items-end', 'mt-4');

        div.innerHTML = `
            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Day</label>
                <select name="schedules[${scheduleIndex}][day_of_week]" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Start Time</label>
                <input type="time" name="schedules[${scheduleIndex}][start_time]" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">End Time</label>
                <input type="time" name="schedules[${scheduleIndex}][end_time]" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div class="flex gap-3 items-end">
                <div class="flex-grow">
                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Session (Mins)</label>
                    <input type="number" name="schedules[${scheduleIndex}][session_duration]" value="60" min="15" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <button type="button" class="removeScheduleBtn bg-red-100 text-red-600 hover:bg-red-200 p-2.5 rounded-lg transition-colors" title="Remove row">
                    <i class="ri-delete-bin-line"></i>
                </button>
            </div>
        `;

        wrapper.appendChild(div);
        scheduleIndex++;
    });

    // Event delegation for dynamically added remove buttons
    document.addEventListener('click', function (e) {
        if (e.target.closest('.removeScheduleBtn')) {
            e.target.closest('.schedule-row').remove();
        }
    });
</script>

@endsection