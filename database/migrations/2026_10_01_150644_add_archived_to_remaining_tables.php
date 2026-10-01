<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_classes', function (Blueprint $table) {
            $table->softDeletes('archived');
        });

        Schema::table('tbl_teachers', function (Blueprint $table) {
            $table->softDeletes('archived');
        });

        Schema::table('tbl_students', function (Blueprint $table) {
            $table->softDeletes('archived');
        });
    }

    public function down(): void
    {
        Schema::table('tbl_classes', function (Blueprint $table) {
            $table->dropSoftDeletes('archived');
        });

        Schema::table('tbl_teachers', function (Blueprint $table) {
            $table->dropSoftDeletes('archived');
        });

        Schema::table('tbl_students', function (Blueprint $table) {
            $table->dropSoftDeletes('archived');
        });
    }
};
