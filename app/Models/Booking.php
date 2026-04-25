<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'therapist_id', 'booking_date', 'booking_time', 'fee', 'name', 'email', 'phone', 'message', 'status',
    ];


    protected $casts = [
        'booking_date' => 'date',
    ];

    protected function bookingDatetime(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->booking_date->format('Y-m-d') . ' ' . $this->booking_time)
        );
    }

    
    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', now()->toDateString())
                     ->whereIn('status', ['Pending', 'Processing', 'Approved']);
    }

    /**
     * Relationship to the User (Patient) model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship to the Therapist model
     */
    public function therapist()
    {
        return $this->belongsTo(Therapist::class);
    }
}