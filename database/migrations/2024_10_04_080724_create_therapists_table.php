<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('therapists', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            // Profile Details
            $table->string('name');
            $table->text('description');
            $table->string('location');
            $table->string('experience');
            $table->enum('status', ['Available', 'Not-Available'])->default('Available');
            $table->string('photopath')->nullable();
            $table->foreignId('specialist_id')->unsigned(); 
            $table->decimal('fee', 8, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('therapists');
    }
};
