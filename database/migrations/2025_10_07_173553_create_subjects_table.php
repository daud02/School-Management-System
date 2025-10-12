<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->string('name');       // subject name
            $table->string('code')->nullable(); // optional subject code
            $table->string('class');      // class/grade
            $table->timestamps();         // created_at & updated_at
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
