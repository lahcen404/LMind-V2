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
        Schema::create('livrables', function (Blueprint $table) {
        $table->id();
        $table->string('url'); 
        $table->foreignId('learner_id')->constrained('learners')->onDelete('cascade');
        $table->foreignId('brief_id')->constrained('briefs')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livrables');
    }
};
