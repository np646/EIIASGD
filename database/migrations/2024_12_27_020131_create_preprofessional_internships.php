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
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('restrict');
            $table->foreignId('academic_period_id')->nullable()->constrained('academic_periods')->onDelete('set null');
            $table->foreignId('external_cert_id')->nullable()->constrained('files')->onDelete('set null');
            $table->foreignId('student_report_id')->nullable()->constrained('files')->onDelete('set null');
            $table->foreignId('banner_cert_id')->nullable()->constrained('files')->onDelete('set null');
            $table->unsignedBigInteger('status')->default(1);
            $table->foreign('status')->references('id')->on('internship_statuses')->onDelete('restrict');
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
