<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'video_url', 'category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class); // Assuming Category is the model for categories
    }
    public function index() {
        $activities = Activity::all(); // Replace `Activity` with your model name
        return view('welcome', compact('activities'));
    }
}
