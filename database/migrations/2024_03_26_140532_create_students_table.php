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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('guardian_id')->constrained()->cascadeOnDelete();
            $table->string('admission_number')->unique();
            $table->foreignId('nationality')->constrained('countries');
            $table->foreignId('state_origin')->constrained('states');
            $table->foreignId('lga_origin')->constrained('lgas');
            $table->enum('religion', ['christianity', 'islam', 'other']);
            $table->enum('blood_group', ['A', 'B', 'AB', 'O']);
            $table->enum('rhesus_factor', ['Rh-positive', 'Rh-negative']);
            $table->string('emergency_contact');
            $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
