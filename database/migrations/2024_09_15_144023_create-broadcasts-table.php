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
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('message');
            $table->string('target_url')->nullable();
            $table->set('status', ['draft', 'pending', 'sent'])->default('draft');

            $table->string('target')->nullable();
            $table->unsignedInteger('target_user_id')->nullable();

            $table->timestamp('schedule')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broadcasts');
    }
};
