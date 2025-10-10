<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('student_id'); // references students.student_id
            $table->string('class'); // class name or code
            $table->date('date'); // attendance date
            $table->enum('status', ['present', 'absent'])->default('absent'); // default absent
            $table->timestamps();

            // Foreign key reference
            $table->foreign('student_id')
                  ->references('student_id')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
