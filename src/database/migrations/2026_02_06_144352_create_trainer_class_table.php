<?php

use App\Enums\TrainerType;
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
        Schema::create('trainer_class', function (Blueprint $table) {
            $table->id();

            $table->foreignId('trainer_id')->constrained('trainers')->onDelete('cascade');
            $table->foreignId('training_class_id')->constrained('training_classes')->onDelete('cascade');

            $table->string('trainer_type')->default(TrainerType::MAIN->value);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_class');
    }
};
