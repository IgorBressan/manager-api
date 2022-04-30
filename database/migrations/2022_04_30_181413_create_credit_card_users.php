<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_card_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->notNullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('credit_card_flags_id')->notNullable();
            $table->foreign('credit_card_flags_id')->references('id')->on('credit_card_flags');
            $table->timestamps(true,true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_card_users');
    }
}
