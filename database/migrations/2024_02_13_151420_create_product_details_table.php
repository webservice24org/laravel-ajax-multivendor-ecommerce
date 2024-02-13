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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->longText('long_description')->nullable();
            $table->longText('product_gallery')->nullable();
            $table->integer('buying_price')->comment('Buying Price');
            $table->integer('tax')->nullable();
            $table->string('sku')->nullable();
            $table->enum('status', ['available', 'out of stock', 'pending', 'suspended'])->default('pending');
            $table->timestamps();
        });
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
