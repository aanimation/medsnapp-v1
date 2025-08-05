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
        // scenario a.k.a. clinical scenario OR quest in gamification
        Schema::create('scenarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('skey')->unique();
            $table->smallInteger('order')->default(0);
            $table->boolean('is_trial')->default(false); //deprecated
            
            $table->string('title')->default('Clinical Scenario');
            $table->text('description');
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->set('sex', ['female', 'male'])->default('male');
            $table->set('status', ['draft', 'pending', 'active', 'inactive'])->default('active');

            $table->json('attributes')->nullable();
            /*
                {
                    "temp": "37.8",
                    "oxy_sat": "97",
                    "hr_rate": "115",
                    "bl_press": "100/65",
                    "resp_rate": "28",
                    "curr_health": "28"
                }
            */

            $table->json('attempts')->nullable(); // default attempt
            /*
                {
                    "examination": 5,
                    "investigation": 10,
                    "treatment": 5
                }
            */

            $table->smallInteger('damage')->default(10); // deprecated
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('approved_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * invs_quests is Inventories and Scenario relationship
         * `specifications` is only for Examination type
         * `patient` column is correct value of Normal Value (Male and Female) on Investigation type
         * `alternates` and `is_optional` are for Treatment
         * `alternates` is array of other inv_id which for alternatively only
         */
        Schema::create('invs_quests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('inv_id')->index('inv_idx');
            $table->foreignId('scenario_id')->index('scenario_idx');
            $table->unsignedInteger('com_id')->nullable(); // component id
            $table->string('patient')->nullable(); // patient value
            $table->text('description')->nullable(); // description use for info next result by pasca
            $table->string('pasca')->nullable(); // Result when 2 steps and description
            $table->longText('specifications')->nullable();

            $table->text('alternates')->nullable();
            $table->boolean('is_optional')->default(false);
            $table->unsignedInteger('depend_by')->nullable(); // required item for next step
            $table->unsignedInteger('recovery')->nullable(); // recovery value in percent
            $table->timestamps();
        });

        /**
         * users_quests is User and Scenario relationship
         * it is used for questboard
         * also used to store status and history of quest
         * also called `cases` in gamification
         */
        Schema::create('users_quests', function (Blueprint $table) {
            $table->bigIncrements('id'); // case id
            $table->foreignId('user_id')->index('user_idx');
            $table->unsignedInteger('scenario_id');
            $table->smallInteger('examination')->default(0); //used attempt count
            $table->smallInteger('investigation')->default(0); //used attempt count
            $table->smallInteger('treatment')->default(0); //used attempt count
            $table->integer('amount')->default(0); // patient health
            $table->integer('reputation')->nullable(); //history of reputation
            $table->boolean('is_revived')->default(false); // for recovery mode
            
            $table->timestamp('revived_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_quests_invs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->foreignId('case_id')->index();
            $table->foreignId('scenario_id')->index();
            $table->foreignId('inv_id')->index();
            $table->smallInteger('before')->default(0); // deprecated
            $table->smallInteger('current')->default(0); // deprecated
            $table->smallInteger('coin')->default(0); // use coin
            $table->integer('exp')->default(0); // got exps
            $table->smallInteger('health')->default(0); // use health
            $table->smallInteger('stock')->default(0); // use inventory stock
            $table->boolean('is_correct')->default(false);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_quests_invs');
        Schema::dropIfExists('users_quests'); // quest is equal scenario
        Schema::dropIfExists('invs_quests'); // association inventories and scenarios
        Schema::dropIfExists('scenarios');
    }
};
