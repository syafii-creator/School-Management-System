<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_school_settings', function (Blueprint $table) {
            $table->id('school_id');
            $table->string('school_name');
            $table->string('npsn')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('academic_year'); // Contoh: 2025/2026
            $table->enum('semester', ['Odd', 'Even'])->default('Odd'); // Ganjil / Genap
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_school_settings');
    }
};
