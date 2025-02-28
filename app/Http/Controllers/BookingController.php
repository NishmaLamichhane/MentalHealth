<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->get();
                        
        return view('bookings.index', compact('bookings'));
    }
    public function approve()
    {
        $bookings = Booking::all(); 
        return view('bookings.approve', compact('bookings'));
    }
    
    public function create($therapistId)
    {
        $therapist = Therapist::findOrFail($therapistId);
        return view('bookings.create', compact('therapist'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'booking_date' => 'required|date',
            'booking_time' => 'required|in:09:00,10:00,11:00,12:00,13:00,14:00,15:00,16:00,17:00',
            'therapist_id' => 'required|exists:therapists,id',
            'message' => 'nullable|string',
        ]);

        // Check if the booking time is already taken
        $existingBooking = Booking::where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->where('therapist_id', $request->therapist_id)
            ->first();

        if ($existingBooking) {
            return redirect()->back()->withErrors(['booking_time' => 'This time slot is already taken.']);
        }

        // Create the booking
        Booking::create([
            'user_id' => Auth::id(),
            'therapist_id' => $request->therapist_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'fee' => $this->calculateFee($request->therapist_id), // Calculate fee based on therapist
            'message' => $request->message,
            'status'=> 'Pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking made successfully!');
    }
    
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $therapists = Therapist::where('status', 'Available')->get(); // Get available therapists for rescheduling
        return view('bookings.edit', compact('booking', 'therapists'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'booking_date' => 'required|date',
            'booking_time' => 'required|in:09:00,10:00,11:00,12:00,13:00,14:00,15:00,16:00,17:00',
        ]);

        // Check if the booking time is already taken
        $existingBooking = Booking::where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->where('id', '!=', $id) // Exclude the current booking ID
            ->first();

        if ($existingBooking) {
            return redirect()->back()->withErrors(['booking_time' => 'This time slot is already taken.']);
        }

        $booking = Booking::findOrFail($id);
        $booking->update([
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking rescheduled successfully!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking canceled successfully!');
    }

    private function calculateFee($therapistId)
    {
        // Assuming each therapist has a fee field; adjust accordingly
        $therapist = Therapist::findOrFail($therapistId);
        return $therapist->fee; // Return the therapist's fee
    }
    
public function updateStatus(Request $request, $id, $status)
{
    $booking = Booking::findOrFail($id);

    // Check if the status is valid
    $validStatuses = ['Pending', 'Processing', 'Approved', 'Rejected'];
    if (!in_array($status, $validStatuses)) {
        return redirect()->back()->with('error', 'Invalid status selected.');
    }

    // Update status
    $booking->status = $status;
    $booking->save();


       //send mail to user
       $data=[
        'name'=>$booking->name,
        'status'=>$status,
    ];
    Mail::send('mail.status',$data,function($message)use($booking){
        $message->to($booking->user->email,$booking->name)->subject('Booking Status');
    });
    
    // return redirect()->back()->with('message', "Product status changed to {$status} successfully.");
    return back()->with('success','Booking is now '.$status);
}
public function history() {
    // Fetch bookings with status 'Approved' or 'Rejected' only
    $bookings = Booking::whereIn('status', ['Approved', 'Rejected'])->get();
    
    return view('bookings.history', compact('bookings'));
}
}
