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
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('title');
            $table->string('description');
            $table->string('type');
            $table->string('url')->nullable(); // deprecated
            $table->string('route')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->unsignedInteger('notification_id');
            $table->boolean('is_read')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_notifications');
        Schema::dropIfExists('notifications');
    }
};
