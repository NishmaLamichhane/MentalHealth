@extends('layouts.app')
@section('content')

<h1 class="text-black font-bold text-3xl pt-3 dark:text-white"><i class="ri-user-star-fill pr-2 text-2xl"></i>Categories</h2>
        <div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>
<div class="text-right mt-5">
    <a href="{{route('category.create')}}" class="bg-black text-white px-5 py-3 rounded-lg">Add Category</a>
</div>
<table class="w-full mt-5 ">
    <tr class="text-white">
        <th class="border p-2 bg-black">S.N</th>
        <th class="border p-2 bg-black">Name</th>
        <th class="border p-2 bg-black">Action</th>
    </tr>
    @foreach($categories as $category)
    <tr class="text-center bg-gray-400">
        <td class="border p-2">{{$category->priority}}</td>
        <td class="border p-2">{{$category->name}}</td>
        <td class="border p-2">
            <a href="{{route('category.edit', $category->id)}}" class="bg-green-900 text-white px-3 py-1 rounded ">Edit</a>
            <a class="bg-red-900 text-white px-3 py-1 rounded cursor-pointer" onclick="showPopup('{{ $category->id }}')">Delete</a>
        </td>
    </tr>
    @endforeach
</table>

<!-- Popup Model -->
<div class="fixed bg-gray-600 inset-0 bg-opacity-50 backdrop-blur-sm items-center hidden justify-center" id="popup">
    <form action="" id="deleteForm" method="POST" class="bg-white px-10 py-5 rounded-lg text-center ">
        @csrf
        @method('DELETE')
        <h3 class="font-bold mb-5 text-lg">Are you sure to delete?</h3>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-900 text-white px-3 py-1 rounded">Yes! Delete</button>
            <a class="bg-red-600 text-white px-3 py-1 rounded cursor-pointer" onclick="hidePopup()">Cancel</a>
        </div>
    </form>
</div>
<!-- End of Popup Model -->

<script>
    function showPopup(id) {
        document.getElementById('popup').classList.remove('hidden');
        document.getElementById('popup').classList.add('flex');
        let form = document.getElementById('deleteForm');
        form.action = "/category/" + id; // Dynamic URL with ID
    }

    function hidePopup() {
        document.getElementById('popup').classList.remove('flex');
        document.getElementById('popup').classList.add('hidden');
    }
</script>
@endsection
