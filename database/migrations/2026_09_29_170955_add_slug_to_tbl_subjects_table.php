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
    Schema::table('tbl_subjects', function (Blueprint $table) {
        $table->string('slug')->unique()->nullable()->after('subject_name');
    });
}

public function down(): void
{
    Schema::table('tbl_subjects', function (Blueprint $table) {
        $table->dropColumn('slug');
    });
}
};
