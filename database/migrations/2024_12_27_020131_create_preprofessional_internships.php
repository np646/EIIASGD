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
       
        Schema::create('preprofessional_internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('cascade'); 
            $table->foreignId('academic_period_id')->nullable()->constrained('academic_periods')->onDelete('cascade'); 
            $table->foreignId('external_report_id')->nullable()->constrained('files')->onDelete('cascade'); 
            $table->foreignId('student_report_id')->nullable()->constrained('files')->onDelete('cascade'); 
            $table->foreignId('banner_cert_id')->nullable()->constrained('files')->onDelete('cascade'); 
            $table->boolean('status')->constrained('internship_statuses')->onDelete('cascade')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preprofessional_internships');
    }
};
