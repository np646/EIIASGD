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
        Schema::create('graduation_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('restrict');
            $table->foreignId('international_cert_id')->nullable()->constrained('files')->onDelete('set null');
            $table->foreignId('english_cert_id')->nullable()->constrained('files')->onDelete('set null');
            $table->foreignId('community_internship_id')->nullable()->constrained('files')->onDelete('set null');
            $table->foreignId('preprofessional_internship_id')->nullable()->constrained('files')->onDelete('set null');
            $table->foreignId('graduation_type_id')->nullable()->constrained('files')->onDelete('set null');
            $table->foreignId('readers_id')->nullable()->constrained('files')->onDelete('set null');
            $table->foreignId('plan_approval_id')->nullable()->constrained('files')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation_files');
    }
};
