@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center">
            <i class="ri-user-settings-line mr-3 text-blue-600"></i>
            Edit Therapist
        </h1>
        <div class="mt-2 h-1 w-24 bg-blue-600 rounded"></div>
        <p class="mt-3 text-gray-600 dark:text-gray-400">
            Update therapist details, dynamic availability schedules, and professional information.
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

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">

            <form action="{{ route('therapist.update', $therapist->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Specialist <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-stethoscope-line text-gray-400"></i>
                        </div>

                        <select name="specialist_id"
                                required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}"
                                    {{ old('specialist_id', $therapist->specialist_id) == $specialist->id ? 'selected' : '' }}>
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
                               value="{{ old('name', $therapist->name) }}"
                               required
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Profile Photo <span class="text-gray-400 font-normal text-xs">(Leave empty to keep current photo)</span>
                    </label>

                    @if($therapist->photopath)
                        <div class="mb-3">
                            <img src="{{ asset('images/therapists/' . $therapist->photopath) }}" alt="Current Photo" class="h-16 w-16 object-cover rounded-lg border border-gray-200 shadow-sm">
                        </div>
                    @endif

                    <div class="relative">
                        <input type="file"
                               name="photopath"
                               class="block w-full text-sm text-gray-700 dark:text-gray-300
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>

                    <textarea name="description"
                              rows="4"
                              required
                              class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                     bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $therapist->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">
                            Location <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="location"
                               value="{{ old('location', $therapist->location) }}"
                               required
                               class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">
                            Experience <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="experience"
                               value="{{ old('experience', $therapist->experience) }}"
                               required
                               class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">
                            Fee (Rs.) <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               name="fee"
                               step="0.01"
                               value="{{ old('fee', $therapist->fee) }}"
                               required
                               class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Working Schedule</h3>
                            <p class="text-sm text-gray-500">Modify the days and times this therapist is available.</p>
                        </div>
                        <button type="button" id="addScheduleBtn" class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-4 py-2 rounded-lg text-sm font-bold flex items-center transition-colors">
                            <i class="ri-add-line mr-1"></i> Add Day
                        </button>
                    </div>

                    <div id="schedulesWrapper" class="space-y-4">
                        @php
                            // Get old input if validation failed, otherwise get existing schedules from DB
                            $schedules = old('schedules', $therapist->schedules ? $therapist->schedules->toArray() : []);
                        @endphp

                        @forelse($schedules as $index => $schedule)
                            <div class="schedule-row bg-gray-50 dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 relative grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                                
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Day</label>
                                    <select name="schedules[{{ $index }}][day_of_week]" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                            <option value="{{ $day }}" {{ (isset($schedule['day_of_week']) && $schedule['day_of_week'] == $day) ? 'selected' : '' }}>{{ $day }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Start Time</label>
                                    <input type="time" name="schedules[{{ $index }}][start_time]" 
                                           value="{{ isset($schedule['start_time']) ? \Carbon\Carbon::parse($schedule['start_time'])->format('H:i') : '' }}" 
                                           required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">End Time</label>
                                    <input type="time" name="schedules[{{ $index }}][end_time]" 
                                           value="{{ isset($schedule['end_time']) ? \Carbon\Carbon::parse($schedule['end_time'])->format('H:i') : '' }}" 
                                           required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>

                                <div class="flex gap-3 items-end">
                                    <div class="flex-grow">
                                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">Session (Mins)</label>
                                        <input type="number" name="schedules[{{ $index }}][session_duration]" 
                                               value="{{ $schedule['session_duration'] ?? 60 }}" 
                                               min="15" required class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <button type="button" class="removeScheduleBtn bg-red-100 text-red-600 hover:bg-red-200 p-2.5 rounded-lg transition-colors" title="Remove row">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
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
                                    <button type="button" class="removeScheduleBtn bg-red-100 text-red-600 hover:bg-red-200 p-2.5 rounded-lg transition-colors" title="Remove row">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="pt-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Profile Status
                    </label>
                    <select name="status"
                            class="block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg
                                   bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500" required>
                        <option value="Available" {{ old('status', $therapist->status) == 'Available' ? 'selected' : '' }}>
                            Available (Active)
                        </option>
                        <option value="Not-Available" {{ old('status', $therapist->status) == 'Not-Available' ? 'selected' : '' }}>
                            Not Available (Hidden)
                        </option>
                    </select>
                </div>

                <div class="flex justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('therapist.index') }}"
                       class="px-5 py-3 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-3 rounded-lg bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold shadow-md transition transform hover:-translate-y-0.5">
                        <i class="ri-save-line mr-1"></i> Update Therapist
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    // Initialize the index based on the number of existing schedules rendered in the loop
    let scheduleIndex = {{ count($schedules) > 0 ? count($schedules) : 1 }};

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

    document.addEventListener('click', function (e) {
        if (e.target.closest('.removeScheduleBtn')) {
            e.target.closest('.schedule-row').remove();
        }
    });
</script>

@endsection