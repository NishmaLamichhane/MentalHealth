@extends('layouts.app')
@section('content')

<h1 class="text-black font-bold text-3xl pt-3 dark:text-white"><i class="ri-psychotherapy-fill pr-2 text-2xl"></i>Therapist</h2>
        <div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>

<div class="text-right mt-5">
    <a href="{{ route('therapist.create') }}" class="bg-black text-white px-5 py-3 rounded-lg">Add Therapist</a>
</div>
<table class="w-full mt-5">
    <tr class="bg-black text-white">
        <th class="border p-2 bg-black text-white">S.N</th>
        <th class="border p-2 bg-black text-white">Name</th>
        <th class="border p-2 bg-black text-white">Photo</th>
        <th class="border p-2 bg-black text-white">Description</th>
        <th class="border p-2 bg-black text-white">Specialization</th>
        <th class="border p-2 bg-black text-white">Location</th>
        <th class="border p-2 bg-black text-white">Experience</th>
        <th class="border p-2 bg-black text-white">Fee</th>
        <th class="border p-2 bg-black text-white">Status</th>
        <th class="border p-2 bg-black text-white">Action</th>
    </tr>
    @foreach($therapists as $therapist)
    <tr class="text-center dark:text-black bg-gray-400 ">
        <td class="border p-2">{{ $loop->iteration }}</td>
        <td class="border p-2">{{ $therapist->name }}</td>
        <td class="border p-2">
            <img src="{{ asset('images/therapists/' . $therapist->photopath) }}" alt="Therapist Photo" class="w-16 h-16">
        </td>
        <td class="border p-2">
            <!-- Description -->
            <span class="truncate-text">
                {{ implode(' ', array_slice(explode(' ', $therapist->description), 0, 15)) }}
                @if(str_word_count($therapist->description) > 10)
                ... <a href="javascript:void(0);" class="text-gray-500 show-more" onclick="toggleDescription(this)">Show More</a>
                <span class="hidden full-text">{{ $therapist->description }}</span>
                @endif
            </span>
        </td>
        <td class="border p-2">
            {{ $therapist->specialist ? $therapist->specialist->name : 'No Specialist Assigned' }}
        </td>
        
        <td class="border p-2">{{ $therapist->location }}</td>
        <td class="border p-2">{{ $therapist->experience }}</td>
        <td class="border p-2">{{ $therapist->fee }}</td>
        <td class="border p-2 text-center">
    <span class="px-3 py-1 rounded-full {{ $therapist->status === 'active' ? 'bg-green-100' : 'bg-gray-400' }} text-black">
        {{ ucfirst($therapist->status) }}
    </span>
</td>

        <td class="border p-2">
            <a href="{{ route('therapist.edit', $therapist->id) }}" class="bg-green-900 mb-2 text-white px-3 py-1  rounded">Edit</a>
            <!-- Delete Button triggers popup -->
            <a class="bg-red-900 text-white px-3 py-1 rounded cursor-pointer" onclick="showPopup('{{ $therapist->id }}')">Delete</a>
        </td>
    </tr>
    @endforeach
</table>

<!-- Popup Model for Deleting Therapist -->
<div class="fixed bg-gray-600 inset-0 bg-opacity-50 backdrop-blur-sm items-center hidden justify-center" id="popup">
    <form id="deleteForm" method="POST" class="bg-white px-10 py-5 rounded-lg text-center">
        @csrf
        @method('DELETE')
        <h3 class="font-bold mb-5 text-lg">Are you sure to delete this therapist?</h3>
        <div class="flex justify-center gap-3">
            <button type="submit" class="bg-blue-900 text-white px-3 py-1 rounded">Yes! Delete</button>
            <a class="bg-red-600 text-white px-3 py-1 rounded cursor-pointer" onclick="hidePopup()">Cancel</a>
        </div>
    </form>
</div>

<!-- Popup JavaScript Logic -->
<script>
    function showPopup(id) {
        document.getElementById('popup').classList.remove('hidden');
        document.getElementById('popup').classList.add('flex');
        let form = document.getElementById('deleteForm');
        form.action = "/therapist/" + id; // Dynamic URL with therapist ID
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