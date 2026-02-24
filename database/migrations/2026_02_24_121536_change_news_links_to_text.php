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
        Schema::table('news', function (Blueprint $table) {
            $table->text('facebook_link')->nullable()->change();
            $table->text('twitter_link')->nullable()->change();
            $table->text('instagram_link')->nullable()->change();
            $table->text('custom_link')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('facebook_link')->nullable()->change();
            $table->string('twitter_link')->nullable()->change();
            $table->string('instagram_link')->nullable()->change();
            $table->string('custom_link')->nullable()->change();
        });
    }
};
