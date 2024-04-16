<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('language_code');
            $table->string('category_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_translations');
    }
};
