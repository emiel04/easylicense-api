<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_lesson_progressions', function (Blueprint $table) {
            $table->id();
            $table->boolean('completed');
            $table->foreignId('user_id');
            $table->foreignId('lesson_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_lesson_progressions');
    }
};
