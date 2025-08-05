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
        Schema::create('rewards', function (Blueprint $table) { //master
            $table->increments('id');
            $table->unsignedSmallInteger('day_num');
            $table->unsignedSmallInteger('month_num');
            $table->unsignedSmallInteger('year_num');
            $table->string('title', 120);
            $table->string('route', 12)->nullable(); // for treatment type only
            $table->smallInteger('amount')->default(1);
            $table->string('icon_url')->nullable(); // deprecated
            $table->string('type', 90)->nullable();
            $table->foreignId('inv_id')->nullable()->index('inv_idx');
            $table->string('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('daily_reward', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->unsignedInteger('reward_id');
            $table->unsignedInteger('inv_id')->nullable(); // store the option if reward has route
            $table->string('day_date', 20);
            $table->tinyInteger('chain')->default(1); // bool is_chained
            
            $table->timestamps();
        });

        Schema::create('daily_coin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->string('day_date', 20);
            $table->smallInteger('coin');
            $table->tinyInteger('chain')->default(1); // bool is_chained
            
            $table->timestamps();
        });

        Schema::create('daily_energy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->string('day_date', 20);
            $table->smallInteger('energy');
            $table->tinyInteger('chain')->default(1); // bool is_chained
            
            $table->timestamps();
        });

        Schema::create('daily_streak', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->boolean('is_connected')->default(false);
            $table->string('day_date', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_streak');
        Schema::dropIfExists('daily_energy');
        Schema::dropIfExists('daily_coin');
        Schema::dropIfExists('daily_reward');
        Schema::dropIfExists('rewards');
    }
};
