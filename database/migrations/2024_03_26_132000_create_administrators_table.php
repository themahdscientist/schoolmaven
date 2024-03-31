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
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('administrator_code')->unique();
            $table->enum('position', ['administrator', 'principal', 'owner'])->default('administrator');
            $table->foreignId('nationality')->nullable()->constrained('countries');
            $table->foreignId('state_origin')->nullable()->constrained('states');
            $table->foreignId('lga_origin')->nullable()->constrained('lgas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrators');
    }
};
