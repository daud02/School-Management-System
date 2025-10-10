<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->string('student_id');   // reference to students.student_id
            $table->string('subject_code'); // reference to subjects.code
            $table->integer('mark');        // numeric mark
            $table->string('exam');         // exam name or type
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
