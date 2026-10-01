<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_teachers', function (Blueprint $table) {
    $table->id('teacher_id');
    $table->foreignId('user_id')->constrained('tbl_users', 'user_id')->onDelete('cascade');
            $table->string('nip')->unique(); // <-- Pastikan baris ini ADA
    $table->string('full_name');
    $table->foreignId('subject_id')->constrained('tbl_subjects', 'subject_id');
    $table->string('phone')->nullable();
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
