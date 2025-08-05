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
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('skey')->unique();
            
            $table->string('name');
            $table->set('type', ['examination', 'investigation', 'treatment']);
            $table->string('category')->nullable();
            $table->string('sub1')->nullable();
            $table->string('sub2')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->longText('specifications')->nullable();

            $table->smallInteger('price')->default(0)->nullable(); // price in shop
            $table->smallInteger('price2')->default(0)->nullable(); // price in actual
            $table->decimal('price_dec', 10, 2)->nullable(); // price in decimal
            $table->integer('damage')->default(10)->nullable();
            $table->mediumInteger('order')->nullable();
            $table->boolean('is_sibling')->default(false);
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inv_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('inv_id')->index('inv_idx');
            $table->string('title');
            $table->unsignedInteger('parent')->nullable(); //deprecated
            $table->string('normal')->nullable(); //male if female not null
            $table->string('female')->nullable();
            $table->string('unit')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->index();
            $table->unsignedInteger('inv_id');
            $table->integer('amount')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_inventories');
        Schema::dropIfExists('inv_components');
        Schema::dropIfExists('inventories');
    }
};
