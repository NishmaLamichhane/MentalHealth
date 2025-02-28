<?php

namespace App\Http\Controllers;

use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProgressController extends Controller
{
    // Show user progress
    public function index()
    {
        $progress = UserProgress::where('user_id', Auth::id())->orderBy('progress_date', 'desc')->paginate(10);
        
        // Prepare data for the chart
        $dataCounts = UserProgress::where('user_id', Auth::id())
            ->selectRaw('progress_date, COUNT(*) as count')
            ->groupBy('progress_date')
            ->orderBy('progress_date')
            ->pluck('count', 'progress_date');

        return view('user_progress.index', compact('progress', 'dataCounts'));
    }

    // Show form to create progress
    public function create()
    {
        return view('user_progress.create');
    }

    // Store user progress
    public function store(Request $request)
    {
        $request->validate([
            'progress_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'progress_date' => 'required|date',
        ]);

        UserProgress::create([
            'user_id' => Auth::id(),
            'progress_title' => $request->progress_title,
            'description' => $request->description,
            'progress_date' => $request->progress_date,
        ]);

        return redirect()->route('user_progress.index')->with('success', 'Progress added successfully.');
    }

    // Show form to edit progress
    public function edit($id)
    {
        $user_progress = UserProgress::findOrFail($id);
        return view('user_progress.edit', compact('user_progress'));
    }

    // Update user progress
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'progress_title' => 'required|string|max:255', 
            'description' => 'required|string',
            'progress_date' => 'required|date', 
        ]);

        // Find the user progress item and update it
        $user_progress = UserProgress::findOrFail($id);
        $user_progress->progress_title = $request->progress_title; 
        $user_progress->description = $request->description;
        $user_progress->progress_date = $request->progress_date; 
        $user_progress->save();

        return redirect()->route('user_progress.index')->with('success', 'User progress updated successfully.');
    }

    public function destroy($id)
    {
        // Find the progress item by ID
        $user_progress = UserProgress::findOrFail($id);

        // Delete the progress item
        $user_progress->delete();

        // Redirect with a success message
        return redirect()->route('user_progress.index')->with('success', 'Progress removed!');
    }
}
