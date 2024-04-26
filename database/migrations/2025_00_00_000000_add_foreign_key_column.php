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

        Schema::table('grades', function (Blueprint $table) {
            $table->foreignId('year_head_id')->nullable()->constrained('staff')->nullOnDelete();
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
