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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('guardian_code')->unique();
            $table->foreignId('nationality')->constrained('countries');
            $table->foreignId('state_origin')->constrained('states');
            $table->foreignId('lga_origin')->constrained('lgas');
            $table->enum('marital_status', ['single', 'married', 'other'])->default('single');
            $table->enum('relationship_to_student', ['father', 'mother', 'guardian']);
            $table->string('occupation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
