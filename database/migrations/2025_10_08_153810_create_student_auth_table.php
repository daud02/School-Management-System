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
        Schema::create('student_auth', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();  // Student’s unique ID
            $table->string('email')->unique();       // Email for login
            $table->string('password');              // Hashed password
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_auth');
    }
};
