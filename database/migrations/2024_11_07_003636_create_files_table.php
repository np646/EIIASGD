<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_folder'); // CARPETA = 1, ARCHIVO = 0
            $table->string(column: 'size')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('files')->onDelete('cascade');
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('set null');
            $table->string(column: 'path');
            $table->integer('level')->default(1);
            $table->foreignId('created_by')->nullable(); // TODO: should be constrained to users table
            $table->foreignId('updated_by')->nullable(); // same as above
            $table->timestamps();
            $table->boolean('status')->default(true);
        });


        DB::table('files')->insert([
            ['name' => 'TITULACION', 'is_folder' => true, 'parent_id' => null, 'path' => '', 'level' => 1, 'created_by' => 1, 'updated_by' => null],
            ['name' => 'VINCULACION', 'is_folder' => true, 'parent_id' => null, 'path' => '', 'level' => 1, 'created_by' => 1, 'updated_by' => null],
            ['name' => 'PREPROFESIONALES', 'is_folder' => true, 'parent_id' => null, 'path' => '', 'level' => 1, 'created_by' => 1, 'updated_by' => null],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
