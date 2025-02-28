@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User Progress</h2>

    <form action="{{ route('user_progress.update', $user_progress->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="progress_title" class="block text-gray-700">Progress Title</label>
            <input type="text" id="progress_title" name="progress_title" value="{{ old('progress_title', $user_progress->progress_title) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea id="description" name="description" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>{{ old('description', $user_progress->description) }}</textarea>
        </div>
        
        <div class="mb-4">
            <label for="progress_date" class="block text-gray-700">Date</label>
            <input type="date" id="progress_date" name="progress_date" value="{{ old('progress_date', $user_progress->progress_date ? $user_progress->progress_date->format('Y-m-d') )}}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Progress</button>
    </form>
</div>
@endsection
