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
        Schema::create('tbl_students', function (Blueprint $table) {
            $table->id('student_id');
            $table->foreignId('user_id')->constrained('tbl_users', 'user_id')->onDelete('cascade');
            $table->string('full_name', 100);
            $table->string('nis', 20)->unique();
            $table->foreignId('class_id')->nullable()->constrained('tbl_classes', 'class_id')->onDelete('set null');
            $table->date('date_of_birth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
