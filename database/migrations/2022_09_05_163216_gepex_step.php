<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GepexStep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'gepex_step',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('gepex_id');
                $table->unsignedBigInteger('step_id');
                $table->integer('finished')->default('0');;
                $table->date('completion_date')->nullable();
                $table->date('prevision_date')->nullable();
                $table->text('obs')->nullable();
                $table->foreign('gepex_id')
                ->references('id')
                    ->on('gepexes')
                    ->onDelete('cascade');

                $table->foreign('step_id')
                ->references('id')
                    ->on('steps')
                    ->onDelete('cascade');
            }
        );
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
