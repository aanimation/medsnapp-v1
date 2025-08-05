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
        Schema::create('question_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('parentId')->nullable();
            $table->smallInteger('order')->default(0);
            
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('skey')->unique();
            $table->foreignId('user_id')->index('user_idx'); // used for user propose a question
            $table->string('title')->nullable();
            $table->text('clinical_vignette');
            $table->string('question');
            $table->mediumInteger('category_id')->nullable();
            $table->json('answers')->nullable();
            $table->text('explanation')->nullable(); // topic description
            $table->string('topic')->nullable(); // topic title
            $table->string('description')->nullable(); // sub topic
            $table->set('status', ['draft', 'pending', 'published', 'trashed'])->default('pending');

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('published_at')->nullable(); // deprecated
            $table->timestamp('trashed_at')->nullable(); // deprecated
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('question_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seesion_code');
            $table->json('question_ids')->nullable();
            $table->json('cat_ids')->nullable(); // DEPRECATED
            $table->foreignId('user_id')->index();
            $table->string('last_question', 50)->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('questions_users', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->index('user_idx');
            $table->foreignId('question_id')->index('question_idx');
            $table->foreignId('session_id')->nullable()->index('session_idx');
            $table->unsignedInteger('answer')->nullable();
            $table->boolean('is_correct')->default(false);
            $table->boolean('is_like')->default(false);
            $table->boolean('is_dislike')->default(false);
            $table->boolean('is_favorite')->default(false);
            $table->boolean('is_flag')->default(false);
            $table->boolean('is_anonym')->default(false);
            $table->string('review')->nullable();
            $table->string('improve')->nullable(); // comment
            
            $table->timestamps();
            $table->softDeletes();
        });

        // DEPRECATED
        Schema::create('question_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('question_id')->index('question_idx');
            $table->foreignId('user_id')->index('user_idx');
            $table->string('comment');
            $table->string('commentator')->default('anonymous');
            $table->unsignedInteger('comment_id')->nullable();
            $table->boolean('is_like')->default(false);
            $table->boolean('is_dislike')->default(false);
            $table->boolean('is_flag')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('question_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('question_id')->index('question_idx');
            $table->integer('correct')->default(0);
            $table->integer('incorrect')->default(0);
            $table->integer('a')->default(0);
            $table->integer('b')->default(0);
            $table->integer('c')->default(0);
            $table->integer('d')->default(0);
            $table->integer('e')->default(0);
            
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_stats');
        Schema::dropIfExists('question_comments'); // Forum
        Schema::dropIfExists('questions_users');
        Schema::dropIfExists('question_sessions');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_cats');
    }
};
