<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use App\Models\Specialist;
use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function index()
    {
        $therapists = Therapist::orderBy('created_at', 'desc')->get();
        return view('therapist.index', compact('therapists'));
    }

    public function create()
    {
        $specialists = Specialist::all();
        return view('therapist.create', compact('specialists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'specialist_id' => 'required|exists:specialists,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'location' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
            'status' => 'required|string|in:Available,Not-Available',
            'photopath' => 'required|image|max:2048',
            'available_time_slots' => 'required|array|min:1',
            'available_time_slots.*' => 'date_format:H:i',
        ]);

        // Prevent duplicate therapist under the same specialist
        $existingTherapist = Therapist::where('specialist_id', $request->specialist_id)
            ->where('name', $request->name)
            ->exists();

        if ($existingTherapist) {
            return back()->withErrors(['name' => 'A therapist with this name already exists under the selected specialist.']);
        }

        $data = $request->except('photopath');
        $data['time_slot'] = $request->available_time_slots;  // Save array directly to JSON column

        if ($request->hasFile('photopath')) {
            $photo = $request->file('photopath');
            $photoName = time() . '.' . $photo->extension();
            $photo->move(public_path('images/therapists'), $photoName);
            $data['photopath'] = $photoName;
        }

        Therapist::create($data);

        return redirect()->route('therapist.index')->with('success', 'Therapist added successfully!');
    }

    public function edit(Therapist $therapist)
    {
        $specialists = Specialist::all();
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
            'status' => 'required|string|in:Available,Not-Available',
            'photopath' => 'nullable|image|max:2048',
            'available_time_slots' => 'required|array|min:1',
            'available_time_slots.*' => 'date_format:H:i',
        ]);

        $therapist->fill($request->only([
            'specialist_id', 'name', 'description', 'location', 'experience', 'fee', 'status'
        ]));

        $therapist->available_time_slot = $request->available_time_slots; // Save array directly

        if ($request->hasFile('photopath')) {
            // Delete old photo if exists
            if ($therapist->photopath && file_exists(public_path('images/therapists/' . $therapist->photopath))) {
                unlink(public_path('images/therapists/' . $therapist->photopath));
            }
            $photo = $request->file('photopath');
            $photoName = time() . '.' . $photo->extension();
            $photo->move(public_path('images/therapists'), $photoName);
            $therapist->photopath = $photoName;
        }

        $therapist->save();

        return redirect()->route('therapist.index')->with('success', 'Therapist updated successfully.');
    }

    public function destroy(Therapist $therapist)
    {
        if ($therapist->photopath && file_exists(public_path('images/therapists/' . $therapist->photopath))) {
            unlink(public_path('images/therapists/' . $therapist->photopath));
        }

        $therapist->delete();

        return redirect()->route('therapist.index')->with('success', 'Therapist deleted successfully.');
    }
}
