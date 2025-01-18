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
            $table->foreignId('student_id')->constrained('students')->onDelete('restrict'); 
            $table->foreignId('academic_period_start_id')->nullable()->constrained('academic_periods')->onDelete('set null'); 
            $table->date('plan_approval_date')->nullable();
            $table->foreignId('graduation_type')->nullable()->constrained('graduation_types')->onDelete('set null'); 
            $table->string('thesis_name')->unique()->nullable();
            $table->foreignId('thesis_area')->nullable()->constrained('thesis_areas')->onDelete('set null'); 
            $table->foreignId('advisor_id')->nullable()->constrained('professors')->onDelete('set null');
            $table->date('advisor_assignment_date')->nullable();
            $table->foreignId('academic_period_end_id')->nullable()->constrained('academic_periods')->onDelete('set null'); 
            $table->foreignId('reader1_id')->nullable()->constrained('professors')->onDelete('set null');
            $table->foreignId('reader2_id')->nullable()->constrained('professors')->onDelete('set null');
            $table->date('readers_assignment_date')->nullable();
            $table->date('graduation_date')->nullable();
            $table->integer('registration_times')->nullable();
            $table->unsignedBigInteger('status')->default(4);
            $table->foreign('status')->references('id')->on('graduation_statuses')->onDelete('restrict');
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
