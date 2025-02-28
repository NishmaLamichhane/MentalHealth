<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;
    protected $fillable= ['priority','name'];
    public function therapists()
    {
        return $this->hasMany(Therapist::class, 'specialist_id');
    }
}
