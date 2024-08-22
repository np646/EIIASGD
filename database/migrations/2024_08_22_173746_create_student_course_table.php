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
        Schema::create('student_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('academic_period_start_id')->constrained('academic_periods')->onDelete('cascade');
            $table->foreignId('academic_period_end_id')->constrained('academic_periods')->onDelete('cascade');
            $table->boolean('status_p_profesionales');
            $table->boolean('status_p_vinculacion');
            $table->boolean('status_titulacion');
            //TODO: check whats wrong with this line
            //$table->unique(['student_id', 'course_id', 'academic_period_start_id', 'academic_period_end_id']);
            $table->boolean('status')->default(true);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_course');
    }
};
