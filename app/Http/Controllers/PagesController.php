<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Specialist;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function activities()
    {
        $activities = Activity::all();
        $categories = Category::all();
        return view('activities', compact('activities', 'categories'));
    }

    public function welcome()
    {
        $therapists = Therapist::where('status', 'Available')->latest()->limit(4)->get();
        return view('welcome', compact('therapists'));
    }

    public function about()
    {
        $therapists = Therapist::all();
        $activities = Activity::latest()->take(6)->get();
        return view('about', compact('activities', 'therapists'));
    }

    public function viewTherapist($id)
    {
        $therapist = Therapist::with('schedules')->findOrFail($id);

        $relatedtherapists = Therapist::where('status', 'Available')
            ->where('specialist_id', $therapist->specialist_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('viewtherapist', compact('therapist', 'relatedtherapists'));
    }

    public function specialisttherapist($id)
    {
        $specialists = Specialist::find($id);
        $therapists  = Therapist::where('status', 'Available')
            ->where('specialist_id', $id)
            ->paginate(1);

        return view('specialisttherapist', compact('therapists', 'specialists'));
    }


    public function search(Request $request)
    {
        // ── MODE 2: Date + Time availability filter ───────────────────────
        if ($request->filled('search_date') || $request->filled('search_time')) {

            $request->validate([
                'search_date' => 'required|date|after_or_equal:today',
                'search_time' => 'required|date_format:H:i',
            ]);

            $date      = $request->search_date;
            $time      = $request->search_time;
            $dayOfWeek = Carbon::parse($date)->format('l'); // e.g. "Monday"

            $therapists = Therapist::where('status', 'Available')
                // Must be scheduled to work on this day within this time window
                ->whereHas('schedules', function ($q) use ($dayOfWeek, $time) {
                    $q->where('day_of_week', $dayOfWeek)
                      ->where('start_time', '<=', $time)
                      ->where('end_time', '>', $time);
                })
                // Must NOT already have an active booking for this exact slot
                ->whereDoesntHave('bookings', function ($q) use ($date, $time) {
                    $q->where('booking_date', $date)
                      ->where('booking_time', $time)
                      ->whereIn('status', ['Pending', 'Processing', 'Approved']);
                })
                ->get();

            // Pass empty collections so the view doesn't break
            $specialists = collect();
            $activities  = collect();

            return view('search', compact('therapists', 'activities', 'specialists', 'date', 'time'));
        }

        // ── MODE 1: Keyword search ─────────────────────────────────────────
        $qry = $request->search;

        $therapists  = Therapist::where('name', 'like', '%' . $qry . '%')
                                ->where('status', 'Available')
                                ->get();
        $specialists = Specialist::where('name', 'like', '%' . $qry . '%')->get();
        $activities  = Activity::where('title', 'like', '%' . $qry . '%')->get();

        // Not an availability search — set null so the view knows
        $date = null;
        $time = null;

        return view('search', compact('therapists', 'activities', 'specialists', 'date', 'time'));
    }
}