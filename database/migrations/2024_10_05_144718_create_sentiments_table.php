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
        Schema::create('sentiments', function (Blueprint $table) {
            $table->id();
            $table->text('sentiment_text')->nullable(true);
            $table->string('positive_count')->nullable(true);
            $table->string('negative_count')->nullable(true);
            $table->string('sentiment_result')->nullable(true);
            $table->string('sentiment_score')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sentiments');
    }
};
