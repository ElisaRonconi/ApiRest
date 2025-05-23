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
            $table->id();
            $table->string('gender');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('uuid');
            $table->string('username')->unique();   //login.username
            $table->string('password');
            $table->string('salt');
            $table->string('md5');
            $table->string('sha1');
            $table->string('sha256');
            $table->string('picture');
            
            $table->timestamps();
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
