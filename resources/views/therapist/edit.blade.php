@extends('layouts.app')
@section('content')
<h1 class="text-4xl font-bold text-black dark:text-white">Edit Therapist</h1>
<div>
    <hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300">
</div>
<div class="mt-5">
    <form action="{{ route('therapist.update', $therapist->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Therapist Specialization -->
        <select name="specialist_id" id="" class="w-full rounded-lg my-2">
            @foreach($specialists as $specialist)
            <option value="{{ $specialist->id }}"
                @if($therapist->specialist_id == $specialist->id) selected @endif>
                {{ $specialist->name }}
            </option>
            @endforeach
        </select>

        <!-- Therapist Name -->
        <input type="text" class="m-2 w-full rounded-lg " name="name" id="name" placeholder="Enter Therapist Name" value="{{ old('name', $therapist->name) }}">
        @error('name')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Photo -->
        <input type="file" class="m-2 w-full rounded-lg  p-2" name="photopath" id="photopath">
        @error('photopath')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Description -->
        <textarea class="m-2 w-full rounded-lg " name="description" id="description" cols="30" rows="5" placeholder="Therapist Description">{{ old('description', $therapist->description) }}</textarea>
        @error('description')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror


        <!-- Therapist Location -->
        <input type="text" class="m-2 w-full rounded-lg " name="location" id="location" placeholder="Enter therapist location" value="{{ old('location', $therapist->location) }}">
        @error('location')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Experience -->
        <input type="text" class="m-2 w-full rounded-lg " name="experience" id="experience" placeholder="Enter therapist experience" value="{{ old('experience', $therapist->experience) }}">
        @error('experience')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Time Slots (Multiple Time Inputs) -->
        <div id="timeSlotsWrapper" class="m-2">
            <label class="block font-semibold mb-2">Available Time Slots</label>
            @php
                $times = old('available_time_slots', $therapist->time_slots ? explode(',', $therapist->time_slots) : []);
            @endphp

            @foreach($times as $time)
                <div class="flex items-center space-x-3 mb-2">
                    <input type="time" name="available_time_slots[]" class="rounded-lg border p-2 w-40" value="{{ $time }}" required>
                    <button type="button" class="removeTimeSlotBtn bg-red-600 text-white px-3 py-1 rounded-lg">Remove</button>
                </div>
            @endforeach

            @if(count($times) == 0)
                <div class="flex items-center space-x-3 mb-2">
                    <input type="time" name="available_time_slots[]" class="rounded-lg border p-2 w-40" required>
                    <button type="button" class="removeTimeSlotBtn bg-red-600 text-white px-3 py-1 rounded-lg">Remove</button>
                </div>
            @endif

            <button type="button" id="addTimeSlotBtn" class="bg-blue-600 text-white px-3 py-1 rounded-lg">+ Add</button>
        </div>
        @error('available_time_slots')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Status -->
        <select class="m-2 w-full rounded-lg  p-2" name="status" id="status">
            <option value="Available" {{ old('status', $therapist->status) == 'Available' ? 'selected' : '' }}>Available</option>
            <option value="Not-Available" {{ old('status', $therapist->status) == 'Not-Available' ? 'selected' : '' }}>Not-Available</option>
        </select>
<!-- my file is not redirecting to index page after update and after clicking ok,done button -->
        @error('status')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
        <!-- not still -->
        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Ok, Done</button>
            <a href="{{ route('therapist.index') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg ml-2">Cancel</a>
        </div>
    </form>
</div>

{{-- JavaScript to dynamically add/remove time inputs --}}
<!-- <script>
    document.getElementById('addTimeSlotBtn').addEventListener('click', function() {
        const wrapper = document.getElementById('timeSlotsWrapper');
        const newField = document.createElement('div');
        newField.classList.add('flex', 'items-center', 'space-x-3', 'mb-2');
        newField.innerHTML = `
            <input type="time" name="available_time_slots[]" class="rounded-lg border p-2 w-40" required>
            <button type="button" class="removeTimeSlotBtn bg-red-600 text-white px-3 py-1 rounded-lg">Remove</button>
        `;
        wrapper.insertBefore(newField, this); // insert before the Add button
    });

    document.getElementById('timeSlotsWrapper').addEventListener('click', function(e) {
        if (e.target.classList.contains('removeTimeSlotBtn')) {
            e.target.parentElement.remove();
        }
    });
</script> -->
@endsection
