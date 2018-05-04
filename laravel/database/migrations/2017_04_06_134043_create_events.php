<?php

use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('amount_paid')->nullable();
            $table->string('attendee_type')->nullable();
            $table->date('payment_date')->default(date('Y-m-d'));
            $table->timestamps();
            $table->softDeletes();
        });


        /*Schema::create('events', function (Blueprint $table) {
            $table->foreign('registered_for')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
