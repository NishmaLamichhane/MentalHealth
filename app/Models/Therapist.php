<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'specialist_id', 'location', 'experience', 'status', 'photopath','fee','time_slot'];

    protected $casts = [
        'time_slot' => 'array', // This automatically casts JSON to array
    ];


    // Define the relationship with the Specialist model
    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }
    
}
