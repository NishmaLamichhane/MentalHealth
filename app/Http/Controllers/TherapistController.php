<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use App\Models\Specialist;
use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function index()
    {
        $therapists = Therapist::all();
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
        ]);

        // Check if a therapist with the same name exists under the same specialist
        $existingTherapist = Therapist::where('specialist_id', $request->specialist_id)
            ->where('name', $request->name)
            ->exists();

        if ($existingTherapist) {
            return back()->withErrors(['name' => 'A therapist with this name already exists under the selected specialist.']);
        }

        $data = $request->all();

        if ($request->hasFile('photopath')) {
            $photo = $request->file('photopath');
            $photoName = time() . '.' . $photo->extension();
            $photo->move(public_path('images/therapists'), $photoName);
            $data['photopath'] = $photoName;
        }

        Therapist::create($data);

        return redirect()->route('therapist.index')->with('success', 'Therapist added successfully!');
    }

    public function edit($id)
    {
        $therapist = Therapist::findOrFail($id);
        $specialists = Specialist::all();
        return view('therapist.edit', compact('therapist', 'specialists'));
    }

    public function update(Request $request, $id)
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
        ]);

        $therapist = Therapist::findOrFail($id);

        // Check if another therapist with the same name exists under the same specialist
        $existingTherapist = Therapist::where('specialist_id', $request->specialist_id)
            ->where('name', $request->name)
            ->where('id', '!=', $id) // Exclude the current therapist being updated
            ->exists();

        if ($existingTherapist) {
            return back()->withErrors(['name' => 'A therapist with this name already exists under the selected specialist.']);
        }

        if ($request->hasFile('photopath')) {
            $photo = $request->file('photopath');
            $photoName = time() . '.' . $photo->extension();
            $photo->move(public_path('images/therapists'), $photoName);
            $therapist->photopath = $photoName;
        }

        $therapist->update($request->only(['specialist_id', 'name', 'description', 'location', 'experience', 'fee', 'status']));

        return redirect()->route('therapist.index')->with('success', 'Therapist updated successfully.');
    }

    public function destroy($id)
    {
        $therapist = Therapist::findOrFail($id);
        $therapist->delete();
        return redirect()->route('therapist.index')->with('success', 'Therapist deleted successfully.');
    }
}
