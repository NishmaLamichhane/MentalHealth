<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id', 'therapist_id', 'booking_date', 'booking_time', 'fee', 'name', 'email', 'phone', 'message', 'status',
    ];
    
    public function user()
{
    return $this->belongsTo(User::class);
}


    // Relationship to the Therapist model
    public function therapist()
    {
        return $this->belongsTo(Therapist::class);
    }
}
