@extends('layouts.app')
@section('content')
<h1 class="text-4xl font-bold text-black dark:text-white">Add Therapist</h1>
<div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>

<div class="mt-5">
    <form action="{{ route('therapist.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Specialist Selection -->
        <select name="specialist_id" id="specialist_id" class="m-2 w-full rounded-lg " required>
            <option value="" disabled selected>Select a Specialist</option>
            @foreach($specialists as $specialist)
            <option value="{{ $specialist->id }}">{{ $specialist->name }}</option>
            @endforeach
        </select>
        @error('specialist_id')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Name -->
        <input type="text" class="m-2 w-full rounded-lg " name="name" placeholder="Enter Therapist Name" value="{{ old('name') }}" required>
        @error('name')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Photo -->
        <input type="file" class="m-2 w-full rounded-lg  p-2" name="photopath" required>
        @error('photopath')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Description -->
        <textarea class="m-2 w-full rounded-lg " name="description" cols="30" rows="5" placeholder="Therapist Description" required>{{ old('description') }}</textarea>
        @error('description')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Location -->
        <input type="text" class="m-2 w-full rounded-lg " name="location" placeholder="Enter Therapist Location" value="{{ old('location') }}" required>
        @error('location')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Experience -->
        <input type="text" class="m-2 w-full rounded-lg " name="experience" placeholder="Enter Therapist Experience" value="{{ old('experience') }}" required>
        @error('experience')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
        <!-- Therapist Fee -->
        <input type="number" step="0.01" class="m-2 w-full rounded-lg" name="fee" placeholder="Enter Therapist Fee" value="{{ old('fee') }}" required>
        @error('fee')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Therapist Status -->
        <select class="m-2 w-full rounded-lg " name="status" required>
            <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
            <option value="Not-Available" {{ old('status') == 'Not-Available' ? 'selected' : '' }}>Not-Available</option>
        </select>
        @error('status')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <!-- Form Submission Buttons -->
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Therapist</button>
            <a href="{{ route('therapist.index') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection