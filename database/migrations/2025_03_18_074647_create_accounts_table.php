<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id("account_id"); 
            $table->string("username")->unique();
            $table->string("password");
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string("email")->unique();
            $table->enum("status",['active','inactive'])->default('active');    
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
