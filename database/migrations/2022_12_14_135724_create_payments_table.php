<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('campaign_id');
            $table->foreignId('campaign_referral_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('to_user_id');
            $table->decimal('amount', 8,2);
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('comment')->nullable();
            $table->string('evidence');
            $table->unsignedTinyInteger('type')->default(1)->comment('1 Pago inicial, 2 Pago devolucion');
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->foreign('to_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
