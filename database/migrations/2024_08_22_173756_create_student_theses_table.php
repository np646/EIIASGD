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
        Schema::create('student_theses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_course_id')->constrained('student_courses')->constrained()->onDelete('cascade');
            $table->string('thesis_name');
            $table->foreignId('thesis_area_id')->constrained('thesis_areas')->onDelete('cascade');
            $table->foreignId('advisor_professor_id')->constrained('professors')->onDelete('cascade');
            $table->foreignId('reader1_professor_id')->constrained('professors')->onDelete('cascade');
            $table->foreignId('reader2_professor_id')->constrained('professors')->onDelete('cascade');
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_theses');
    }
};
