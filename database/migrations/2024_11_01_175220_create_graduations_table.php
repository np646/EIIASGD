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
        Schema::create('graduations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); 
            $table->foreignId('academic_period_start_id')->nullable()->constrained('academic_periods')->onDelete('cascade'); 
            $table->date('plan_approval_date')->nullable();
            $table->foreignId('graduation_type')->nullable()->constrained('graduation_types')->onDelete('cascade'); 
            $table->string('thesis_name')->unique()->nullable();
            $table->foreignId('thesis_area')->nullable()->constrained('thesis_areas')->onDelete('cascade'); 
            $table->foreignId('advisor_id')->nullable()->constrained('professors')->onDelete('cascade');
            $table->foreignId('academic_period_end_id')->nullable()->constrained('academic_periods')->onDelete('cascade'); 
            $table->foreignId('reader1_id')->nullable()->constrained('professors')->onDelete('cascade');
            $table->foreignId('reader2_id')->nullable()->constrained('professors')->onDelete('cascade');
            $table->date('graduation_date')->nullable();
            $table->integer('registration_times')->nullable();
            $table->boolean('status')->constrained('graduation_statuses')->onDelete('cascade')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation');
    }
};
