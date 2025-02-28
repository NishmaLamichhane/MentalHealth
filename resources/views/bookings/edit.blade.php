
@extends('layouts.master')
@section('content')

<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Reschedule Booking</h2>
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="booking_date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="booking_date" id="booking_date" value="{{ $booking->booking_date }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"   min="{{ now()->toDateString() }}" required>
        </div>
        <div class="mb-4">
            <label for="booking_time" class="block text-sm font-medium text-gray-700">Time Slot</label>
            <select name="booking_time" id="booking_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="{{ $booking->booking_time }}">{{ $booking->booking_time }}</option>
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
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Booking</button>
    </form>
</div>

@endsection
