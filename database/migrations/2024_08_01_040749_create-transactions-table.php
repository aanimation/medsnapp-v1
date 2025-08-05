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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('skey')->unique();

            $table->unsignedBigInteger('user_id')->index('user_idx');

            $table->string('trans_code', 30);
            $table->string('trans_type', 90);
            $table->datetime('trans_datetime');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            
            $table->string('payment_type')->nullable();
            $table->decimal('payment_amount', 10, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->longText('payment_url')->nullable();
            $table->longText('payment_note')->nullable();
            $table->timestamp('payment_datetime')->nullable();

            $table->decimal('tax_fee', 10, 2)->default(0); // 0 == included
            $table->decimal('trans_fee', 10, 2)->default(0);
            $table->json('promo')->nullable();
            

            $table->set('status', ['paid', 'unpaid', 'archived', 'cancelled', 'trashed', 'refund'])->default('unpaid');
            $table->index('status');

            $table->timestamp('paid_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('refund_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['user_id', 'trans_code'], 'unique_trans_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
