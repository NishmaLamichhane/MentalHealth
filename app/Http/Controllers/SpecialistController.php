<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = Specialist::orderBy('priority', 'asc')->get();
        return view('specialist.index', compact('specialists'));
    }

    public function create()
    {
        return view('specialist.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            // 'priority' => 'numeric|required|unique:specialists,priority',
            'name' => 'required|string|max:255|unique:specialists,name',
        ], [
            // 'priority.unique'=>'This priority has already been assigned to previous specialization.',
            'name.unique' => 'The specialist name has already been taken. Please choose another name.',
        ]);

        // Generate the lowest missing priority (e.g., 1, 2, 3...)
        $existingPriorities = Specialist::pluck('priority')->toArray();
        $priority = 1;

        while (in_array($priority, $existingPriorities)) {
            $priority++;
        }

        $data['priority'] = $priority;
        // Create a new specialist
        Specialist::create($data);
        return redirect()->route('specialist.index')->with('success', 'Speciality Added Successfully');
    }

    public function edit(Specialist $specialist)
    {
        return view('specialist.edit', compact('specialist'));
    }

    public function update(Request $request, $id)
    {
        // Find the existing specialist
        $specialist = Specialist::findOrFail($id);

        // Validate the request data, excluding the current specialist's name
        $data = $request->validate([
            'priority' => 'numeric|required',
            'name' => 'required|string|max:255|unique:specialists,name,' . $specialist->id,
        ], [
            'name.unique' => 'The specialist name has already been taken. Please choose another name.',
        ]);

        // Update the specialist
        $specialist->update($data);
        return redirect()->route('specialist.index')->with('success', 'Speciality Updated Successfully');
    }
    public function destroy($id)
    {
        $specialist = Specialist::findOrFail($id);
        $specialist->delete();
        // Reorder priorities to be continuous
        $specialists = Specialist::orderBy('priority', 'asc')->get();

        $priority = 1;
        foreach ($specialists as $spec) {
            // Only update if priority is different to avoid unnecessary writes
            if ($spec->priority != $priority) {
                $spec->priority = $priority;
                $spec->save();
            }
            $priority++;
        }

        return redirect()->route('specialist.index')->with('success', 'Specialist deleted successfully.');
    }
}
