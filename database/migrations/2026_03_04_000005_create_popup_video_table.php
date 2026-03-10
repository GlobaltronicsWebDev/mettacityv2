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
            $table->string('video_url');
            $table->enum('video_type', ['youtube', 'vimeo', 'facebook'])->default('youtube');
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
