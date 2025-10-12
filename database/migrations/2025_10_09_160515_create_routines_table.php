<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->string('class'); // e.g. 'CSE 2nd Year'
            $table->integer('row');  // 0-3 for time slot index
            $table->integer('col');  // 0-4 for day index
            $table->string('subject')->nullable();
            $table->string('instructor')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routines');
    }
};
