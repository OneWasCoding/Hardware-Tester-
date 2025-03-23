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
        Schema::create('item_gallery', function (Blueprint $table) {
            $table->unsignedBigInteger("item_id");
            $table->string("img_name");
            $table->timestamps(false);

            $table->foreign("item_id")->references("item_id")->on("items")->onDelete("cascade")->onUpdate("cascade");
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_gallery');
    }
};
