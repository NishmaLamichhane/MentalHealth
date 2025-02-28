<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Specialist;
use App\Models\Therapist;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $specialists = Specialist::count();
        $therapists = Therapist::count();
        // $waiting_list = Appointment::where('status', 'Waiting')->count();
        // $booked = Appointment::where('status', 'Booked')->count();
        // $cancel = Appointment::where('status', 'Cancelled')->count();
        // If there's no status column:
        // Just count all appointments

        $mindfulness = Activity::count();
        // Count the number of approved, rejected, and pending bookings
        $approved = Booking::where('status', 'Approved')->count();
        $rejected = Booking::where('status', 'Rejected')->count();
        $pending = Booking::where('status', 'Pending')->count();
        return view('dashboard', compact('specialists', 'therapists',  'mindfulness', 'pending', 'approved', 'rejected'));
    }
}
