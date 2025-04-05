<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id('cart_id');
            $table->unsignedBigInteger('user_id'); // Foreign key for users table
            $table->unsignedBigInteger('item_id'); // Foreign key for items table
            $table->integer('quantity')->default(1);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('item_id')
                  ->references('item_id')
                  ->on('items')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart');
    }
}