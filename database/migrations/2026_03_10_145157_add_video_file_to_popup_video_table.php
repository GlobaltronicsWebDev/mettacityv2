<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('popup_video', function (Blueprint $table) {
            if (!Schema::hasColumn('popup_video', 'video_file')) {
                $table->string('video_file')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('popup_video', function (Blueprint $table) {
            if (Schema::hasColumn('popup_video', 'video_file')) {
                $table->dropColumn('video_file');
            }
        });
    }
};
