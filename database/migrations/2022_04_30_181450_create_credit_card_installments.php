<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardInstallments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_card_installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_card_users_id')->notNullable();
            $table->foreign('credit_card_users_id')->references('id')->on('credit_card_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_card_installments');
    }
}
