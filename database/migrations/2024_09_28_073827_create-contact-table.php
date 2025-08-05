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
        Schema::create('contact_msg', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_read')->default(false);
            $table->string('subject')->default('message');
            $table->text('message');
            $table->set('priority', ['high', 'medium', 'low', 'default'])->default('default');
            $table->set('status', ['solved', 'pending', 'archived', 'trashed'])->default('pending');
            $table->string('part')->nullable(); //Reason for reaching out

            $table->unsignedInteger('user_id')->nullable();
            $table->text('extra')->nullable(); // deprecated

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_msg');
    }
};
