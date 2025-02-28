@extends('layouts.app')

@section('content')
<h1 class="text-4xl font-bold text-black dark:text-white">Add Mindfulness Activity</h1>
<div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>

<form action="{{ route('mindfulness_activities.store') }}" method="POST" class="mt-5">
    @csrf

    <div class="mb-4  ">
        <label for="title" class="block mb-2 dark:text-white">Title:</label>
        <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-lg p-2 border @error('title') border-red-500 @enderror">
        @error('title')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block mb-2 dark:text-white">Description:</label>
        <textarea name="description" required class="w-full rounded-lg p-2 border @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
        @error('description')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="video_url" class="block mb-2 dark:text-white">YouTube Video URL:</label>
        <input type="url" name="video_url" value="{{ old('video_url') }}" required class="w-full rounded-lg p-2 border @error('video_url') border-red-500 @enderror">
        @error('video_url')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="category_id" class="block mb-2 dark:text-white">Category:</label>
        <select name="category_id" required class="w-full rounded-lg p-2 border @error('category_id') border-red-500 @enderror">
            <option value="" disabled selected>Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex justify-center text-white">
        <input type="submit" value="Add in list" class="bg-blue-600 text-white p-2 m-3 rounded-lg cursor-pointer">
        <a href="{{route('mindfulness_activities.index')}}" class="bg-red-600 p-2 m-3 cursor-pointer rounded-lg">Cancel,Go back</a>
        </div>
        
</form>

@endsection
