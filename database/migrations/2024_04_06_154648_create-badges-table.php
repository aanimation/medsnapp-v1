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
        Schema::create('badges', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('skey')->unique();
            $table->unsignedSmallInteger('order')->default(99);
            $table->string('badge_name');
            $table->string('category')->index();
            $table->unsignedInteger('requirement')->index();
            $table->string('description')->nullable(); // Deprecated
            $table->string('icon')->nullable(); // deprecated
            $table->string('image_url')->nullable(); // deprecated
            $table->json('specification')->nullable(); //deprecated
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_badges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->unsignedInteger('badge_id');
            $table->boolean('is_claimed')->default(false);
            $table->string('track_his')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_badges');
        Schema::dropIfExists('badges');
    }
};
