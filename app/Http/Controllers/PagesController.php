<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Specialist;
use App\Models\Therapist;
use Illuminate\Http\Request;

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
        $therapists = Therapist::where('status', 'Available')->latest()->limit(4)->get(); // Fetch all therapists from the database
        return view('welcome', compact('therapists'));
    }
    public function about()
    {
        $therapists = Therapist::all(); // or with pagination/ordering
        $activities = Activity::latest()->take(6)->get(); // show 6 activities on about page
        return view('about', compact('activities', 'therapists'));
    }   
    public function viewTherapist($id)
{
    $therapist = Therapist::findOrFail($id);

    // Fetch related therapists (example: therapists from the same specialist or category)
    $relatedtherapists = Therapist::where('status', 'Available')->where('specialist_id', $therapist->specialist_id)
        ->where('id', '!=', $id)
        ->take(4)
        ->get();

    return view('viewtherapist', compact('therapist', 'relatedtherapists'));
}

    public function specialisttherapist($id)
    {
        $specialists = Specialist::find($id);
        $therapists = Therapist::where('status','Available')->where('specialist_id',$id)->paginate(1);
        return view('specialisttherapist', compact('therapists','specialists')); 
    }

    public function search(Request $request)
{
    $qry = $request->search;
  // Fetch results
  $therapists = Therapist::where('name', 'like', '%' . $qry . '%')->where('status', 'Available')->get();
  $specialists = Specialist::where('name', 'like', '%' . $qry . '%')->get();
  $activities = Activity::where('title', 'like', '%' . $qry . '%')->get();


    return view('search', compact('therapists','activities','specialists'));
}

}


