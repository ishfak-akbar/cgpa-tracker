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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('season');           // Fall, Spring, Summer
            $table->year('year');               // 2020–2030 etc.
            $table->string('name')->nullable(); // optional: "Fall 2025"
            $table->decimal('gpa', 4, 2)->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'season', 'year']); // prevent duplicates
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
