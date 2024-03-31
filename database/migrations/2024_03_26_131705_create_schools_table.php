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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('smil_code')->unique();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->string('address');
            $table->string('postal_code')->nullable();
            $table->json('info'); // email_address;website_url;
            $table->string('accreditation')->nullable();
            $table->json('type');
            $table->json('affiliation')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->string('logo')->nullable();
            $table->date('established_date');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
