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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('staff_code')->unique();
            $table->string('position_title');
            $table->foreignId('nationality')->constrained('countries');
            $table->foreignId('state_origin')->constrained('states');
            $table->foreignId('lga_origin')->constrained('lgas');
            $table->json('qualifications')->nullable();
            $table->enum('contract_type', ['full-time', 'part-time', 'contractual'])->default('full-time');
            $table->date('contract_expiry_date')->nullable();
            $table->enum('marital_status', ['single', 'married', 'other'])->default('single');
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_relationship')->nullable();
            $table->decimal('salary', 10, 2);
            $table->json('bank_details')->nullable(); // Ensure compliance with data protection laws
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
