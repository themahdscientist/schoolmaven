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
            $table->foreignId('country_id')->constrained()->nullOnDelete();
            $table->foreignId('state_id')->constrained()->nullOnDelete();
            $table->foreignId('lga_id')->constrained()->nullOnDelete();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('country_id')->constrained()->nullOnDelete();
            $table->foreignId('state_id')->constrained()->nullOnDelete();
            $table->foreignId('lga_id')->constrained()->nullOnDelete();
            $table->foreignId('nationality_id')->constrained('countries')->nullOnDelete();
            $table->foreignId('state_origin_id')->constrained('states')->nullOnDelete();
            $table->foreignId('lga_origin_id')->constrained('lgas')->nullOnDelete();
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
