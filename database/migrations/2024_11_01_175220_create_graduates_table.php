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
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); 
            $table->foreignId('academic_period_start_id')->constrained('academic_periods')->onDelete('cascade'); 
            $table->date('plan_approval_date');
            $table->foreignId('graduation_type')->constrained('graduation_types')->onDelete('cascade'); 
            $table->string('thesis_name')->unique();
            $table->foreignId('thesis_area')->constrained('thesis_areas')->onDelete('cascade'); 
            $table->foreignId('advisor_id')->constrained('professors')->onDelete('cascade');
            $table->foreignId('academic_period_end_id')->constrained('academic_periods')->onDelete('cascade'); 
            $table->foreignId('reader1_id')->constrained('professors')->onDelete('cascade');
            $table->foreignId('reader2_id')->constrained('professors')->onDelete('cascade');
            $table->date('graduation_date');
            $table->integer('registration_times');
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduates');
    }
};
