<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;

use Illuminate\Http\Request;

class ActivityController extends Controller
{   
    public function index()
    {
        
        $activities = Activity::all();
        return view('mindfulness_activities.index', compact('activities'));
    }

    public function create()
    {
        $categories = Category::all(); // Fetch categories to show in the create form
        return view('mindfulness_activities.create', compact('categories'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

       Activity::create($request->all());
        
        return redirect()->route('mindfulness_activities.index')->with('success', 'Activity created successfully');
    }

    public function edit($id)
{
    $activity = Activity::findOrFail($id);
    $categories = Category::all(); // Ensure you are retrieving categories
    return view('mindfulness_activities.edit', compact('activity', 'categories'));
}


    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        $activity->update($request->all());
        
        return redirect()->route('mindfulness_activities.index')->with('success', 'Activity updated successfully');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        
        return redirect()->route('mindfulness_activities.index')->with('success', 'Activity deleted successfully');
    }
}
