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
        Schema::create('community_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->foreignId('academic_period_id')->nullable()->constrained('academic_periods')->onDelete('cascade'); 
            $table->foreignId('project_report_id')->nullable()->constrained('files')->onDelete('set null'); 
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_projects');
    }
};
