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
        Schema::create('tbl_classes', function (Blueprint $table) {
            $table->id('class_id');
            $table->string('class_name', 50);
            $table->foreignId('homeroom_teacher_id')
                  ->nullable()
                  ->constrained('tbl_teachers', 'teacher_id')
                  ->onDelete('set null');
            $table->string('academic_year', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_classes');
    }
};
