<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TherapistController extends Controller
{
    public function index()
    {
        // Eager load schedules to prevent N+1 query performance issues
        $therapists = Therapist::with('schedules')->latest()->get();
        return view('therapist.index', compact('therapists'));
    }

    public function create()
    {
        $specialists = Specialist::all();
        return view('therapist.create', compact('specialists'));
    }

    public function store(Request $request)
    {
        // 1. Professional Validation for Profile AND Dynamic Schedules
        $request->validate([
            'specialist_id' => 'required|exists:specialists,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'location' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Not-Available',
            'photopath' => 'required|image|max:2048',
            
            // Dynamic Schedule Validation
            'schedules' => 'required|array|min:1',
            'schedules.*.day_of_week' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'schedules.*.start_time' => 'required|date_format:H:i',
            'schedules.*.end_time' => 'required|date_format:H:i|after:schedules.*.start_time',
            'schedules.*.session_duration' => 'required|integer|min:15',
        ]);

        // 2. Prevent duplicate therapist profiles
        $exists = Therapist::where('specialist_id', $request->specialist_id)
            ->where('name', $request->name)
            ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'This therapist already exists under the selected specialist.'])->withInput();
        }

        // 3. Handle Image Upload First
        $filename = null;
        if ($request->hasFile('photopath')) {
            $file = $request->file('photopath');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/therapists'), $filename);
        }

        // 4. Secure Database Transaction
        DB::transaction(function () use ($request, $filename) {
            $data = $request->only([
                'specialist_id', 'name', 'description', 'location', 'experience', 'fee', 'status'
            ]);
            $data['photopath'] = $filename;

            // Create Therapist Profile
            $therapist = Therapist::create($data);

            // Create Related Schedules dynamically
            $therapist->schedules()->createMany($request->schedules);
        });

        return redirect()->route('therapist.index')
            ->with('success', 'Therapist and schedule created successfully!');
    }

    public function edit(Therapist $therapist)
    {
        $specialists = Specialist::all();
        // Load the therapist with their existing schedules for the edit form
        $therapist->load('schedules'); 
        return view('therapist.edit', compact('therapist', 'specialists'));
    }

    public function update(Request $request, Therapist $therapist)
    {
        $request->validate([
            'specialist_id' => 'required|exists:specialists,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'location' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Not-Available',
            'photopath' => 'nullable|image|max:2048',
            
            // Dynamic Schedule Validation
            'schedules' => 'required|array|min:1',
            'schedules.*.day_of_week' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'schedules.*.start_time' => 'required|date_format:H:i',
            'schedules.*.end_time' => 'required|date_format:H:i|after:schedules.*.start_time',
            'schedules.*.session_duration' => 'required|integer|min:15',
        ]);

        $filename = $therapist->photopath;

        // Image Update Logic
        if ($request->hasFile('photopath')) {
            // Delete old image safely
            if ($filename && file_exists(public_path('images/therapists/' . $filename))) {
                unlink(public_path('images/therapists/' . $filename));
            }

            $file = $request->file('photopath');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/therapists'), $filename);
        }

        // Secure Database Transaction for Updates
        DB::transaction(function () use ($request, $therapist, $filename) {
            
            // Update Basic Fields
            $therapist->update(array_merge(
                $request->only(['specialist_id', 'name', 'description', 'location', 'experience', 'fee', 'status']),
                ['photopath' => $filename]
            ));

            // Cleanest way to update schedules: wipe the old ones and insert the new ones
            $therapist->schedules()->delete();
            $therapist->schedules()->createMany($request->schedules);
        });

        return redirect()->route('therapist.index')
            ->with('success', 'Therapist updated successfully!');
    }

    public function destroy(Therapist $therapist)
    {
        // Secure Deletion
        DB::transaction(function () use ($therapist) {
            
            // 1. Delete image file
            if ($therapist->photopath && file_exists(public_path('images/therapists/' . $therapist->photopath))) {
                unlink(public_path('images/therapists/' . $therapist->photopath));
            }

            // 2. Delete the therapist (Foreign Key cascades will auto-delete schedules)
            $therapist->delete();
        });

        return redirect()->route('therapist.index')
            ->with('success', 'Therapist deleted successfully!');
    }
}