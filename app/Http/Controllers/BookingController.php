<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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
        $therapist = Therapist::with('schedules')->findOrFail($therapistId);
        return view('bookings.create', compact('therapist'));
    }

    /**
     * DYNAMIC SLOT GENERATOR
     * Called via AJAX when a user selects a date on the booking form.
     * Returns available time slots based on the therapist's schedule and existing bookings.
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'therapist_id' => 'required|exists:therapists,id',
            'date'         => 'required|date|after_or_equal:today',
        ]);

        $therapist   = Therapist::with('schedules')->findOrFail($request->therapist_id);
        $date        = Carbon::parse($request->date);
        $dayOfWeek   = $date->format('l'); // e.g. "Monday"

        // Find the schedule for that day
        $schedule = $therapist->schedules->firstWhere('day_of_week', $dayOfWeek);

        if (!$schedule) {
            return response()->json([
                'slots'   => [],
                'message' => 'This therapist is not available on ' . $dayOfWeek . '.',
            ]);
        }

        // Generate all possible slots from start_time to end_time
        $slots           = [];
        $slotDuration    = (int) $schedule->session_duration;   // e.g. 60 mins
        $breakDuration   = (int) ($schedule->break_duration ?? 0); // e.g. 15 mins
        $stepMinutes     = $slotDuration + $breakDuration;

        $current = Carbon::parse($request->date . ' ' . $schedule->start_time);
        $end     = Carbon::parse($request->date . ' ' . $schedule->end_time);

        // A slot is valid only if it ENDS by or at $end
        while ($current->copy()->addMinutes($slotDuration)->lte($end)) {
            $slots[] = $current->format('H:i');
            $current->addMinutes($stepMinutes);
        }

        if (empty($slots)) {
            return response()->json([
                'slots'   => [],
                'message' => 'No slots could be generated for this schedule. Please check session/break duration.',
            ]);
        }

        // Fetch already-booked times for this therapist on this date
        $bookedTimes = Booking::where('therapist_id', $therapist->id)
            ->where('booking_date', $request->date)
            ->whereIn('status', ['Pending', 'Processing', 'Approved'])
            ->pluck('booking_time')
            ->map(fn($t) => Carbon::parse($t)->format('H:i'))
            ->toArray();

        // Optionally exclude past slots if today is selected
        $now = Carbon::now();

        $result = array_map(function ($slot) use ($bookedTimes, $date, $now) {
            $slotTime = Carbon::parse($date->format('Y-m-d') . ' ' . $slot);
            $isPast   = $date->isToday() && $slotTime->lte($now);
            $isTaken  = in_array($slot, $bookedTimes);

            return [
                'time'      => $slot,
                'label'     => Carbon::parse($slot)->format('h:i A'),
                'available' => !$isPast && !$isTaken,
                'reason'    => $isPast ? 'past' : ($isTaken ? 'booked' : null),
            ];
        }, $slots);

        return response()->json([
            'slots'       => $result,
            'day'         => $dayOfWeek,
            'schedule'    => [
                'start'            => Carbon::parse($schedule->start_time)->format('h:i A'),
                'end'              => Carbon::parse($schedule->end_time)->format('h:i A'),
                'session_duration' => $slotDuration,
            ],
        ]);
    }

    /**
     * Same slot generator but excludes a specific booking_id (for reschedule).
     */
    public function getAvailableSlotsForEdit(Request $request, $bookingId)
    {
        $request->validate([
            'therapist_id' => 'required|exists:therapists,id',
            'date'         => 'required|date|after_or_equal:today',
        ]);

        $therapist = Therapist::with('schedules')->findOrFail($request->therapist_id);
        $date      = Carbon::parse($request->date);
        $dayOfWeek = $date->format('l');

        $schedule = $therapist->schedules->firstWhere('day_of_week', $dayOfWeek);

        if (!$schedule) {
            return response()->json([
                'slots'   => [],
                'message' => 'This therapist is not available on ' . $dayOfWeek . '.',
            ]);
        }

        $slots         = [];
        $slotDuration  = (int) $schedule->session_duration;
        $breakDuration = (int) ($schedule->break_duration ?? 0);
        $stepMinutes   = $slotDuration + $breakDuration;

        $current = Carbon::parse($request->date . ' ' . $schedule->start_time);
        $end     = Carbon::parse($request->date . ' ' . $schedule->end_time);

        while ($current->copy()->addMinutes($slotDuration)->lte($end)) {
            $slots[] = $current->format('H:i');
            $current->addMinutes($stepMinutes);
        }

        if (empty($slots)) {
            return response()->json([
                'slots'   => [],
                'message' => 'No slots could be generated for this schedule.',
            ]);
        }

        // Exclude the current booking being edited from the "taken" list
        $bookedTimes = Booking::where('therapist_id', $therapist->id)
            ->where('booking_date', $request->date)
            ->where('id', '!=', $bookingId)
            ->whereIn('status', ['Pending', 'Processing', 'Approved'])
            ->pluck('booking_time')
            ->map(fn($t) => Carbon::parse($t)->format('H:i'))
            ->toArray();

        $now = Carbon::now();

        $result = array_map(function ($slot) use ($bookedTimes, $date, $now) {
            $slotTime = Carbon::parse($date->format('Y-m-d') . ' ' . $slot);
            $isPast   = $date->isToday() && $slotTime->lte($now);
            $isTaken  = in_array($slot, $bookedTimes);

            return [
                'time'      => $slot,
                'label'     => Carbon::parse($slot)->format('h:i A'),
                'available' => !$isPast && !$isTaken,
                'reason'    => $isPast ? 'past' : ($isTaken ? 'booked' : null),
            ];
        }, $slots);

        return response()->json([
            'slots'    => $result,
            'day'      => $dayOfWeek,
            'schedule' => [
                'start'            => Carbon::parse($schedule->start_time)->format('h:i A'),
                'end'              => Carbon::parse($schedule->end_time)->format('h:i A'),
                'session_duration' => $slotDuration,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'therapist_id' => 'required|exists:therapists,id',
            'message'      => 'nullable|string|max:500',
        ]);

        // 1. Prevent booking in the past
        $bookingDateTime = Carbon::parse($request->booking_date . ' ' . $request->booking_time);
        if ($bookingDateTime->isPast()) {
            return redirect()->back()->withErrors(['booking_time' => 'You cannot book an appointment in the past.'])->withInput();
        }

        // 2. Validate that the slot actually belongs to the therapist's schedule
        $therapist = Therapist::with('schedules')->findOrFail($request->therapist_id);
        $dayOfWeek = Carbon::parse($request->booking_date)->format('l');
        $schedule  = $therapist->schedules->firstWhere('day_of_week', $dayOfWeek);

        if (!$schedule) {
            return redirect()->back()->withErrors(['booking_date' => 'This therapist is not available on ' . $dayOfWeek . '.'])->withInput();
        }

        // 3. Validate the time is a valid generated slot
        if (!$this->isValidSlot($request->booking_time, $schedule)) {
            return redirect()->back()->withErrors(['booking_time' => 'The selected time is not a valid slot for this therapist.'])->withInput();
        }

        // 4. Double-booking check
        $isTaken = Booking::where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->where('therapist_id', $request->therapist_id)
            ->whereIn('status', ['Pending', 'Processing', 'Approved'])
            ->exists();

        if ($isTaken) {
            return redirect()->back()->withErrors(['booking_time' => 'Sorry, this slot is already taken. Please choose another time.'])->withInput();
        }

        Booking::create([
            'user_id'      => Auth::id(),
            'therapist_id' => $request->therapist_id,
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'fee'          => $therapist->fee,
            'message'      => $request->message,
            'status'       => 'Pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking made successfully!');
    }

    public function edit($id)
    {
        $booking   = Booking::findOrFail($id);
        $therapist = Therapist::with('schedules')->findOrFail($booking->therapist_id);
        return view('bookings.edit', compact('booking', 'therapist'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
        ]);

        $booking = Booking::findOrFail($id);

        $bookingDateTime = Carbon::parse($request->booking_date . ' ' . $request->booking_time);
        if ($bookingDateTime->isPast()) {
            return redirect()->back()->withErrors(['booking_time' => 'You cannot reschedule to a time in the past.'])->withInput();
        }

        // Validate schedule
        $therapist = Therapist::with('schedules')->findOrFail($booking->therapist_id);
        $dayOfWeek = Carbon::parse($request->booking_date)->format('l');
        $schedule  = $therapist->schedules->firstWhere('day_of_week', $dayOfWeek);

        if (!$schedule) {
            return redirect()->back()->withErrors(['booking_date' => 'This therapist is not available on ' . $dayOfWeek . '.'])->withInput();
        }

        if (!$this->isValidSlot($request->booking_time, $schedule)) {
            return redirect()->back()->withErrors(['booking_time' => 'The selected time is not a valid slot for this therapist.'])->withInput();
        }

        // Double-booking check excluding current booking
        $isTaken = Booking::where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->where('therapist_id', $booking->therapist_id)
            ->where('id', '!=', $id)
            ->whereIn('status', ['Pending', 'Processing', 'Approved'])
            ->exists();

        if ($isTaken) {
            return redirect()->back()->withErrors(['booking_time' => 'This time slot is already taken.'])->withInput();
        }

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

    public function updateStatus(Request $request, $id, $status)
    {
        $booking = Booking::findOrFail($id);

        $validStatuses = ['Pending', 'Processing', 'Approved', 'Rejected'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status selected.');
        }

        $booking->status = $status;
        $booking->save();

        $data = ['name' => $booking->name, 'status' => $status];

        Mail::send('mail.status', $data, function ($message) use ($booking) {
            $message->to($booking->user->email, $booking->name)->subject('Booking Status');
        });

        return back()->with('success', 'Booking is now ' . $status);
    }

    public function history()
    {
        $bookings = Booking::whereIn('status', ['Approved', 'Rejected'])->get();
        return view('bookings.history', compact('bookings'));
    }

    /**
     * Helper: Check if a given time string is a valid generated slot for a schedule.
     */
    private function isValidSlot(string $time, $schedule): bool
    {
        $slotDuration  = (int) $schedule->session_duration;
        $breakDuration = (int) ($schedule->break_duration ?? 0);
        $stepMinutes   = $slotDuration + $breakDuration;

        // We need a dummy date to use Carbon; the date doesn't matter for slot validity
        $dummyDate = '2000-01-01';
        $current   = Carbon::parse($dummyDate . ' ' . $schedule->start_time);
        $end       = Carbon::parse($dummyDate . ' ' . $schedule->end_time);
        $target    = Carbon::parse($dummyDate . ' ' . $time);

        while ($current->copy()->addMinutes($slotDuration)->lte($end)) {
            if ($current->format('H:i') === $target->format('H:i')) {
                return true;
            }
            $current->addMinutes($stepMinutes);
        }

        return false;
    }
}