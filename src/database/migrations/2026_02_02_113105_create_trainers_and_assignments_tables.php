<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Trainners table

        Schema::create('trainers', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });

    // piivot table
    
    Schema::create('trainer_class', function (Blueprint $table) {
        $table->id();
        $table->foreignId('trainer_id')->constrained('trainers')->onDelete('cascade');
        $table->foreignId('training_class_id')->constrained('training_classes')->onDelete('cascade');
        $table->enum('trainer_type', ['Main', 'Backup'])->default('Main');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers_and_assignments_tables');
    }
};
