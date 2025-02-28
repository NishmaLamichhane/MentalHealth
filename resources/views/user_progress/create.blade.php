@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-center mb-6">Add Progress</h1>
    <form action="{{ route('user_progress.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
        @csrf
        <div class="mb-4">
            <label for="progress_title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="progress_title" id="progress_title" class="block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="4" class="block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
        </div>
        <div class="mb-4">
            <label for="progress_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" name="progress_date" id="progress_date" class="block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-200">Save Progress</button>
    </form>
</div>
@endsection
