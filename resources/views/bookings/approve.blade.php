@extends('layouts.app')
@section('content')

<h1 class="text-black font-bold text-3xl pt-3 dark:text-white"><i class="ri-psychotherapy-fill pr-2 text-2xl"></i>Appointment Status</h2>
        <div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>
<div class="text-right mt-5">
    <a href="{{route('bookings.history')}}" class="bg-black text-white px-5 py-3 rounded-lg">Appointment History</a>
</div>
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
                <th class="border p-2 ">Actions</th>
            </tr>
       
        <tbody>
            @foreach ($bookings as $booking)
            @if($booking->status !== 'Approved' && $booking->status!=='Rejected')
                <tr class="text-center bg-gray-400">
                    <td class="border p-2">{{ $booking->therapist->name }}</td>
                    <td class="border p-2">{{ $booking->name }}</td>
                    <td class="border p-2">{{ $booking->email }}</td>
                    <td class="border p-2">{{ $booking->phone }}</td>
                    <td class="border p-2">{{ $booking->booking_date }}</td>
                    <td class="border p-2">{{ $booking->booking_time }}</td>
                    <td class="border p-2">{{ $booking->therapist->fee }}</td>
                    <td class="border p-2">{{ $booking->message }}</td>
                    <td class="border p-2">{{ $booking->status }}</td>
                    <td class="border p-2 grid gap-2">
                <a href="{{route('bookings.updateStatus',['id'=> $booking->id,'status' =>'Pending'])}}" class="bg-blue-600 text-white px-2 py-1 rounded-lg">Pending</a>
                <a href="{{route('bookings.updateStatus',['id'=> $booking->id,'status' =>'Approved'])}}" class="bg-green-600 text-white px-2 py-1 rounded-lg">Approved</a>
                <a href="{{route('bookings.updateStatus',['id'=> $booking->id,'status' =>'Rejected'])}}" class="bg-red-600 text-white px-2 py-1 rounded-lg">Rejected</a>
            </td>
                   
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>


@endsection
