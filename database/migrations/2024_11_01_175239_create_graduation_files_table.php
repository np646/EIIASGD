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
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('international_cert_id')->nullable()->constrained('files')->onDelete('set null');
            $table->string('english_cert_id')->nullable()->constrained('files')->onDelete('set null');
            $table->string('community_internship_id')->nullable()->constrained('files')->onDelete('set null');
            $table->string('preprofessional_internship_id')->nullable()->constrained('files')->onDelete('set null');
            $table->string('graduation_type_id')->nullable()->constrained('files')->onDelete('set null');
            $table->string('readers_id')->nullable()->constrained('files')->onDelete('set null');
            $table->string('plan_approval_id')->nullable()->constrained('files')->onDelete('set null');
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
