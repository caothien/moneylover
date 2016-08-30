<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id_wallet');
            $table->string('name_wallet');
            $table->integer('money_wallet');
            $table->integer('id_type')->unsigned();
            $table->foreign('id_type')->references('id_type')->on('typemoneys');
            $table->string('note_wallet');
            $table->string('avatar_wallet');
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
        Schema::drop('wallets');
    }
}
