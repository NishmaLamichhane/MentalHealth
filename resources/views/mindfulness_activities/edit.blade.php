@extends('layouts.app')

@section('content')
<h1 class="text-4xl font-bold text-black dark:text-white">Edit Mindfulness Activity</h1>
<div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>
<div class="mt-5">
    <form action="{{ route('mindfulness_activities.update', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" class="m-2 w-full rounded-lg" name="title" placeholder="Activity Title" value="{{ old('title', $activity->title) }}" required>
        @error('title')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <textarea class="m-2 w-full rounded-lg" name="description" rows="5" placeholder="Activity Description" required>{{ old('description', $activity->description) }}</textarea>
        @error('description')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <input type="url" class="m-2 w-full rounded-lg" name="video_url" placeholder="YouTube Video URL" value="{{ old('video_url', $activity->video_url) }}">
        @error('video_url')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <select name="category_id" class="m-2 w-full rounded-lg" required>
            <option value="" disabled>Select a Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $activity->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update Activity</button>
            <a href="{{ route('mindfulness_activities.index') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg ml-2">Cancel</a>
        </div>
    </form>
</div>
@endsection
