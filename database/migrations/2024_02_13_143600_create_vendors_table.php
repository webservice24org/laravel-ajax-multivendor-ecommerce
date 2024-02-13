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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->string('company_name');
            $table->string('contact_person');
            $table->string('phone_number');
            $table->string('company_address')->nullable();
            $table->string('phone')->unique();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('fbPage')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending', 'suspended'])->default('pending');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
