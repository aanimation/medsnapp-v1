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
        Schema::table('users', function (Blueprint $table) {
            $table->string('ref_code')->index('ref_code_idx')->nullable(); //referral_code
            $table->unsignedBigInteger('ref_by')->nullable(); //referred_by
            $table->integer('ref_count')->default(0); //referral_count
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
