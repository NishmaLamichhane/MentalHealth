<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('therapist_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('therapist_id')->constrained()->onDelete('cascade');
            
            // E.g., 'Monday', 'Tuesday', etc.
            $table->string('day_of_week'); 
            
            // Their working hours for that specific day
            $table->time('start_time'); 
            $table->time('end_time');   
            
            // DYNAMIC CONTROLS: 
            // How long is the therapy session? (e.g., 45 or 60 minutes)
            $table->integer('session_duration')->default(60); 
            
            // Does the therapist need a break between sessions? (e.g., 15 mins)
            $table->integer('break_duration')->default(0); 
            
            $table->timestamps();

            // Ensure a therapist doesn't accidentally set two schedules for the same Monday
            $table->unique(['therapist_id', 'day_of_week']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('therapist_schedules');
    }
};