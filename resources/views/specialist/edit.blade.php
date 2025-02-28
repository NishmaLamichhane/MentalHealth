@extends('layouts.app')
@section('content')
<h1 class="text-4xl font-bold text-black dark:text-white">Edit Specialist</h1>
<div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>
<div class="mt-5">
    <form action="{{ route('specialist.update', $specialist->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="number" name="priority" class="w-full rounded-lg  p-3 m-3" placeholder="Enter Priority" id="priority" value="{{ old('priority', $specialist->priority) }}">
        @error('priority')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
     
        <input type="text" name="name" class="w-full rounded-lg  p-3 m-3" placeholder="Enter Specialities" id="name" value="{{ old('name', $specialist->name) }}">
        @error('name')
        <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
        
        <div class="flex justify-center text-white">
            <button type="submit" class="bg-blue-600 px-4 m-3 cursor-pointer rounded-lg">Update</button>
            <a href="{{ route('specialist.index') }}" class="bg-red-600 p-2 m-3 cursor-pointer rounded-lg">Cancel, Go back</a>
        </div>
    </form>
@endsection
