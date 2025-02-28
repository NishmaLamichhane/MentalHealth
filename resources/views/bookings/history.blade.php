@extends('layouts.app')
@section('content')
<h1 class="text-black font-bold text-3xl pt-3 dark:text-white"><i class="ri-psychotherapy-fill pr-2 text-2xl"></i>Appointment History</h2>
        <div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>

<table class="w-full mt-5">
            <tr class="bg-black text-white">
                <th class="border p-2 ">Therapist</th>
                <th class="border p-2 ">Name</th>
                <th class="border p-2 ">Email</th>
                <th class="border p-2 ">Phone</th>
                <th class="border p-2 ">Date</th>
                <th class="border p-2 ">Time</th>
                <th class="border p-2 ">Fee</th>
                <th class="border p-2 ">Message</th>
                <th class="border p-2 ">Status</th>
            </tr>
       
        <tbody>
            @foreach ($bookings as $booking)
                <tr class="text-center bg-gray-400 ">
                    <td class="border p-2">{{ $booking->therapist->name }}</td>
                    <td class="border p-2">{{ $booking->name }}</td>
                    <td class="border p-2">{{ $booking->email }}</td>
                    <td class="border p-2">{{ $booking->phone }}</td>
                    <td class="border p-2">{{ $booking->booking_date }}</td>
                    <td class="border p-2">{{ $booking->booking_time }}</td>
                    <td class="border p-2">{{ $booking->therapist->fee }}</td>
                    <td class="border p-2">{{ $booking->message }}</td>
                    <td class="border p-2">{{ $booking->status }}</td>           
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex justify-center">
            <a href="{{ route('bookings.approve') }}" class="bg-black text-white px-4 mt-5 py-2 rounded ml-2">Go Back</a>
        </div>
</div>


@endsection
