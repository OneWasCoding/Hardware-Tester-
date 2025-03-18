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
        Schema::create('users', function (Blueprint $table) {
            $table->id("user_id");
            $table->unsignedBigInteger("account_id");
            $table->string("fname");
            $table->string("lname");
            $table->integer("age");
            $table->enum("gender",["male","female"]);
            $table->string("img")->nullable();
            $table->string("contact")->unique();
            $table->timestamps();
            $table->unique(['fname','lname']);
            $table->foreign("account_id")->references("account_id")->on("accounts")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
