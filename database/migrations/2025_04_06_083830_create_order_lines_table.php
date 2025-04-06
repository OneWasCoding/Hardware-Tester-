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
        Schema::create('order_lines', function (Blueprint $table) {
            $table->id('order_line_id'); // Primary key for each order line
            $table->unsignedBigInteger('order_id'); // Foreign key referencing the orders table
            $table->unsignedBigInteger('item_id'); // Foreign key referencing the products table
            $table->integer('order_qty'); // Quantity of the product ordered
            $table->decimal('price', 10, 2); // Price of the product at the time of the order
            $table->timestamps(); // Created_at and updated_at timestamps
        
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade')->onUpdate('cascade'); // Foreign key constraint for order_id
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade')->onUpdate('cascade'); // Foreign key constraint for item_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lines');
    }
};
