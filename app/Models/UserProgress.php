<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'progress_title',
        'description',
        'progress_date',
        'status',
    ];
    protected $casts = [
    'progress_date' => 'date',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
