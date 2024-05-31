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
        Schema::table('schools', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('lga_id')->nullable()->constrained()->nullOnDelete();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('school_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('lga_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('nationality_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('state_origin_id')->nullable()->constrained('states')->nullOnDelete();
            $table->foreignId('lga_origin_id')->nullable()->constrained('lgas')->nullOnDelete();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('classroom_id')->nullable()->constrained()->nullOnDelete();
        });

        Schema::table('grades', function (Blueprint $table) {
            $table->foreignId('year_head_id')->nullable()->constrained('staff')->nullOnDelete();
        });
        
        Schema::table('classrooms', function (Blueprint $table) {
        $table->foreignId('staff_id')->nullable()->constrained()->nullOnDelete();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropConstrainedForeignId('country_id');
            $table->dropConstrainedForeignId('state_id');
            $table->dropConstrainedForeignId('lga_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('school_id');
            $table->dropConstrainedForeignId('country_id');
            $table->dropConstrainedForeignId('state_id');
            $table->dropConstrainedForeignId('lga_id');
            $table->dropConstrainedForeignId('nationality_id');
            $table->dropConstrainedForeignId('state_origin_id');
            $table->dropConstrainedForeignId('lga_origin_id');
        });

        Schema::table('grades', function (Blueprint $table) {
            $table->dropConstrainedForeignId('year_head_id');
        });
    }
};
