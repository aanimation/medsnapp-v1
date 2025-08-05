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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('tier_code')->unique();
            $table->string('tier_name');
            $table->string('tier_desc')->nullable();
            $table->json('features')->nullable();
            $table->json('promo')->nullable();
            $table->decimal('price')->default(0); // monthly price
            $table->decimal('total_price')->default(0); // yearly price
            $table->smallInteger('size')->default(0);
            $table->set('status', ['draft', 'pending', 'active', 'inactive', 'transhed'])->default('draft');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subscribers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('subscription_id')->index('subs_idx');
            $table->unsignedBigInteger('user_id')->index('user_idx');
            $table->unsignedBigInteger('trans_id')->index('trans_idx');

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            $table->set('status', ['pending', 'active', 'expired', 'locked'])->default('pending');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');
        Schema::dropIfExists('subscriptions');
    }
};
