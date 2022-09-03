<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGepexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gepexes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid', 155)->unique();
            $table->text('needs')->nullable();
            $table->text('strategies')->nullable();
            $table->text('goals')->nullable();
            $table->date('completion_date')->nullable();
            $table->unsignedBigInteger('secretary_id')->nullable();
            $table->integer('priority')->nullable();
            $table->string('status')->nullable();
            
            $table->timestamps();

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
        Schema::dropIfExists('gepexes');
    }
}
