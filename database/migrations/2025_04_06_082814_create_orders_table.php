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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // Primary key for the order
            $table->unsignedBigInteger('account_id'); // Foreign key referencing the users table
            $table->decimal('total_amount', 10, 2); // Total order amount
            $table->enum('order_status',['pending','shipped','completed']); // Status of the order (e.g., 'pending', 'shipped', 'completed')
            $table->text('shipping_address'); // Shipping address
            $table->timestamps(); // Created_at, updated_at timestamps

            $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade')->onUpdate('cascade'); // Foreign key constraint for account_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};