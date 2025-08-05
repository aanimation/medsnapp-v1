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
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name');
            $table->boolean('is_active')->default(true);
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('skey')->unique();
            $table->foreignId('role_id');

            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->set('sex', ['default', 'female', 'male'])->default('default');
            $table->string('rank')->nullable();
            $table->string('level')->default(1);
            $table->string('reputation')->default(0);

            $table->string('verify_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');
            $table->rememberToken();
            $table->timestamp('login_at')->nullable();
            $table->timestamp('logout_at')->nullable();
            $table->unsignedInteger('signin_times')->default(0);
            $table->unsignedInteger('signout_times')->default(0);

            $table->boolean('is_new')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_locked')->default(true); // used default for Request Demo

            $table->string('web_token')->nullable(); // pusher
            $table->string('fcm_token')->nullable(); // deprecated
            $table->string('google_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('dob')->nullable();
            $table->unsignedSmallInteger('age')->nullable();
            $table->string('country')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->string('university')->nullable();
            $table->unsignedInteger('university_id')->nullable();
            
            //Student OR Healthcare Professional OR Other
            $table->string('speciality')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_student')->default(false);
            $table->string('student_type')->nullable(); // student
            $table->string('profession')->nullable(); // professional
            $table->string('other')->nullable(); // if not student or professional

            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            
            $table->timestamps();
        });

        Schema::create('users_atts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->integer('health')->default(0);
            $table->integer('points')->default(0);
            $table->integer('coins')->default(100);
            $table->integer('exps')->default(10);
            $table->integer('max_health')->default(100);
            $table->integer('max_points')->default(100);
            $table->integer('max_coins')->default(100);
            $table->integer('max_exps')->default(100);
            
            $table->timestamps();
        });

        Schema::create('users_atts_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->integer('health')->nullable();
            $table->integer('points')->nullable();
            $table->integer('coins')->nullable();
            $table->integer('exps')->nullable();
            $table->set('status', ['treatment', 'purchase', 'topup', 'bonus', 'reward', 'badge', 'system'])->default('system');
            
            $table->timestamps();
        });

        Schema::create('invites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->string('from', 20)->default('invite');
            $table->string('email', 120);
            $table->text('response')->nullable();
            $table->set('status', ['pending', 'accepted']);
            $table->unsignedInteger('player_id')->nullable();
            $table->smallInteger('sent_count')->default(1);
            $table->integer('coins')->default(0);
            
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('login_attempts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->nullable()->index();
            $table->string('email')->index();
            $table->ipAddress('ip_address');
            $table->boolean('success')->default(false);
            $table->text('user_agent')->nullable();
            $table->json('extras')->nullable();
            $table->timestamps();
        });

        Schema::create('heatmap_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index('user_idx');
            $table->smallInteger('week');
            $table->smallInteger('day_week');
            $table->integer('activity')->default(0);
            $table->integer('question')->default(0);
            $table->integer('patient')->default(0);
            $table->integer('shop')->default(0);
            $table->integer('other')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heatmap_stats');
        Schema::dropIfExists('login_attempts');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');

        Schema::dropIfExists('invites');

        Schema::dropIfExists('users_atts_logs');
        Schema::dropIfExists('users_info');
        Schema::dropIfExists('users_atts');

        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};
