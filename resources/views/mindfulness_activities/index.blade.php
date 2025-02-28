@extends('layouts.app')
@section('content')

<h1 class="text-black font-bold text-3xl pt-3 dark:text-white"><i class="ri-empathize-fill pr-2 text-2xl"></i>Mindfulness Activity</h1>
<div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300"></div>
<div class="text-right mt-5">
    <a href="{{ route('mindfulness_activities.create') }}" class="bg-black text-white px-5 py-3 rounded-lg">Add Mindfulness Activity</a>
</div>
<table class="w-full mt-5">
    <tr class="bg-black text-white">
        <th class="border p-2">S.N</th>
        <th class="border p-2">Title</th>
        <th class="border p-2">Description</th>
        <th class="border p-2">Video</th>
        <th class="border p-2">Category</th>
        <th class="border p-2">Action</th>
    </tr>
    @foreach($activities as $activity)
    <tr class="text-center bg-gray-400">
        <td class="border p-2">{{ $loop->index + 1 }}</td> <!-- S.N -->
        <td class="border p-2">{{ $activity->title }}</td> <!-- Title -->
        <td class="border p-2">
            <!-- Description -->
            <span class="truncate-text">
                {{ implode(' ', array_slice(explode(' ', $activity->description), 0, 15)) }}
                @if(str_word_count($activity->description) > 15)
                ... <a href="javascript:void(0);" class="text-gray-500 show-more" onclick="toggleDescription(this)">Show More</a>
                <span class="hidden full-text">{{ $activity->description }}</span>
                @endif
            </span>
        </td>
        <td class="border p-2">
            <!-- Video -->
            <div class="flex justify-center">
                <div class="video-container relative" style="width: 100%; padding-top: 56.25%;">
                    <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $activity->video_url }}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </td>
        <td class="border p-2">{{ $activity->category->name }}</td>
        <td class="border p-2">
            <a href="{{ route('mindfulness_activities.edit', $activity->id) }}" class="bg-green-900 text-white px-3 py-1 rounded">Edit</a>
            <a class="bg-red-900 text-white px-3 py-1 rounded cursor-pointer" onclick="showPopup('{{ $activity->id }}')">Delete</a>
        </td>
    </tr>
    @endforeach
</table>

<!-- Popup Model -->
<div class="fixed bg-gray-600 inset-0 bg-opacity-50 backdrop-blur-sm items-center hidden justify-center" id="popup">
    <form action="" id="deleteForm" method="POST" class="bg-white px-10 py-5 rounded-lg text-center">
        @csrf
        @method('DELETE')
        <h3 class="font-bold mb-5 text-lg">Are you sure you want to delete?</h3>
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
        form.action = "/mindfulness_activities/" + id; // Update the URL with the correct endpoint
    }

    function hidePopup() {
        document.getElementById('popup').classList.remove('flex');
        document.getElementById('popup').classList.add('hidden');
    }

    function toggleDescription(el) {
        const parent = el.closest('.truncate-text');
        const fullText = parent.querySelector('.full-text');
        if (fullText.classList.contains('hidden')) {
            fullText.classList.remove('hidden');
            el.textContent = 'Show Less';
        } else {
            fullText.classList.add('hidden');
            el.textContent = 'Show More';
        }
    }
</script>

@endsection
