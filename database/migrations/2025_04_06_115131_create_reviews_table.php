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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id'); // Primary key for the reviews table
            $table->unsignedBigInteger('user_id'); // Foreign key referencing the users table
            $table->unsignedBigInteger('item_id'); // Foreign key referencing the items table
            $table->integer('rating'); // Rating given by the user
            $table->text('review'); // Review text provided by the user
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade')->onUpdate('cascade');   
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};