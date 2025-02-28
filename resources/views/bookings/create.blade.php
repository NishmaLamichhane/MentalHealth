@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Book a Session with {{$therapist->name}}</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="therapist_id" value="{{ $therapist->id }}">

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            <span id="nameError" class="text-red-500 text-sm hidden"></span>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            <span id="emailError" class="text-red-500 text-sm hidden"></span>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            <span id="phoneError" class="text-red-500 text-sm hidden"></span>
        </div>

        <div class="mb-4">
            <label for="booking_date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="booking_date" id="booking_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" min="{{ now()->toDateString() }}" required>
            <span id="dateError" class="text-red-500 text-sm hidden"></span>
        </div>

        <div class="mb-4">
            <label for="booking_time" class="block text-sm font-medium text-gray-700">Time Slot</label>
            <select name="booking_time" id="booking_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Select Time</option>
                <option value="09:00">09:00 AM</option>
                <option value="10:00">10:00 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="12:00">12:00 PM</option>
                <option value="13:00">01:00 PM</option>
                <option value="14:00">02:00 PM</option>
                <option value="15:00">03:00 PM</option>
                <option value="16:00">04:00 PM</option>
                <option value="17:00">05:00 PM</option>
            </select>
            <span id="timeError" class="text-red-500 text-sm hidden"></span>
        </div>

        <div class="mb-4">
            <label for="fee" class="block text-sm font-medium text-gray-700">Therapist Fee</label>
            <input type="text" name="fee" id="fee" value="{{ $therapist->fee }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly>
        </div>

        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea name="message" id="message" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            <span id="messageError" class="text-red-500 text-sm hidden"></span>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Book Now</button>
    </form>
</div>

<script>
document.getElementById('bookingForm').addEventListener('submit', function(event) {
    // Clear previous error messages
    document.getElementById('nameError').classList.add('hidden');
    document.getElementById('emailError').classList.add('hidden');
    document.getElementById('phoneError').classList.add('hidden');
    document.getElementById('dateError').classList.add('hidden');
    document.getElementById('timeError').classList.add('hidden');
    document.getElementById('messageError').classList.add('hidden');

    let isValid = true;

    // Name Validation
    const name = document.getElementById('name').value;
    if (name.trim() === '') {
        document.getElementById('nameError').innerText = 'Name is required.';
        document.getElementById('nameError').classList.remove('hidden');
        isValid = false;
    }

    // Email Validation
    const email = document.getElementById('email').value;
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        document.getElementById('emailError').innerText = 'Please enter a valid email address.';
        document.getElementById('emailError').classList.remove('hidden');
        isValid = false;
    }

    // Phone Validation
    const phone = document.getElementById('phone').value;
    const phonePattern = /^[0-9]{10}$/; // Adjust this pattern as needed
    if (!phone.match(phonePattern)) {
        document.getElementById('phoneError').innerText = 'Please enter a valid 10-digit phone number.';
        document.getElementById('phoneError').classList.remove('hidden');
        isValid = false;
    }

    // Date Validation
    const bookingDate = document.getElementById('booking_date').value;
    if (bookingDate === '') {
        document.getElementById('dateError').innerText = 'Date is required.';
        document.getElementById('dateError').classList.remove('hidden');
        isValid = false;
    }

    // Time Slot Validation
    const bookingTime = document.getElementById('booking_time').value;
    if (bookingTime === '') {
        document.getElementById('timeError').innerText = 'Please select a time slot.';
        document.getElementById('timeError').classList.remove('hidden');
        isValid = false;
    }

    // Message Validation (optional)
    const message = document.getElementById('message').value;
    if (message.length > 500) {
        document.getElementById('messageError').innerText = 'Message cannot exceed 500 characters.';
        document.getElementById('messageError').classList.remove('hidden');
        isValid = false;
    }

    // Prevent form submission if validation fails
    if (!isValid) {
        event.preventDefault();
    }
});
</script>
@endsection
