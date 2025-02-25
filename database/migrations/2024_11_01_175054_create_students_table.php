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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->date('date_of_birth');
            $table->string('identification')->unique();
            $table->string('email')->unique();
            $table->string('banner_code')->unique();
            $table->boolean('sex'); //0 - FEMALE, 1 MALE
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null'); 
            $table->foreignId('academic_period_start_id')->nullable()->constrained('academic_periods')->onDelete('set null'); 
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
