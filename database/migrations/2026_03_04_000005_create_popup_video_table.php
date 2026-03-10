<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('popup_video', function (Blueprint $table) {
            $table->id();
            $table->string('video_file')->nullable();
            $table->string('video_url')->nullable();
            $table->enum('video_type', ['local', 'youtube', 'vimeo', 'facebook'])->default('local');
            $table->boolean('is_active')->default(true);
            $table->integer('delay_seconds')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('popup_video');
    }
};
