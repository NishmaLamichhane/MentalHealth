@extends('layouts.master')

@section('content')

<div class="container mx-auto mt-10 px-4">
    <h2 class="text-3xl font-bold text-center mb-6 text-blue-700">Your Bookings</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto shadow-md rounded-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="py-3 px-4 border-b">Therapist</th>
                    <th class="py-3 px-4 border-b">Name</th>
                    <th class="py-3 px-4 border-b">Email</th>
                    <th class="py-3 px-4 border-b">Phone</th>
                    <th class="py-3 px-4 border-b">Date</th>
                    <th class="py-3 px-4 border-b">Time</th>
                    <th class="py-3 px-4 border-b">Fee</th>
                    <th class="py-3 px-4 border-b">Status</th>
                    <th class="py-3 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4 border-b">{{ $booking->therapist->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->phone }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->booking_date }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->booking_time }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->therapist->fee }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->status }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($booking->status == 'Pending')
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="text-blue-600 hover:underline">Reschedule</a>
                                |
                                <a class="text-red-600 cursor-pointer hover:underline" onclick="showCancelPopup('{{ $booking->id }}')">Cancel</a>
                            @else
                                <span class="text-gray-500">No actions available</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Cancel Appointment Popup Modal -->
<div class="fixed bg-gray-600 inset-0 bg-opacity-50 backdrop-blur-sm items-center hidden justify-center" id="cancelPopup">
    <form id="cancelForm" method="POST" class="bg-white px-10 py-5 rounded-lg text-center shadow-lg">
        @csrf
        @method('DELETE')
        <h3 class="font-bold mb-5 text-lg text-blue-800">Are you sure you want to cancel this appointment?</h3>
        <div class="flex justify-center gap-3">
            <button type="submit" class="bg-blue-900 text-white px-3 py-1 rounded shadow hover:bg-blue-700 transition duration-200">Yes! Cancel</button>
            <a class="bg-red-600 text-white px-3 py-1 rounded cursor-pointer no-underline hover:bg-red-500 transition duration-200" onclick="hideCancelPopup()">No, Go back</a>
        </div>
    </form>
</div>

<!-- Popup JavaScript Logic -->
<script>
    function showCancelPopup(id) {
        document.getElementById('cancelPopup').classList.remove('hidden');
        document.getElementById('cancelPopup').classList.add('flex');
        let form = document.getElementById('cancelForm');
        form.action = "/bookings/" + id; // Dynamic URL with booking ID
    }

    function hideCancelPopup() {
        document.getElementById('cancelPopup').classList.remove('flex');
        document.getElementById('cancelPopup').classList.add('hidden');
    }
</script>
@endsection
