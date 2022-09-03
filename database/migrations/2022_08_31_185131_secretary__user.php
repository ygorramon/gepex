<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SecretaryUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'secretary_user',
            function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('secretary_id');

        $table->foreign('user_id')
        ->references('id')
            ->on('users')
            ->onDelete('cascade');

        $table->foreign('secretary_id')
        ->references('id')
            ->on('secretaries')
            ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
