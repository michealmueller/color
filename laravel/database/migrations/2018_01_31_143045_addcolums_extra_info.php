<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddcolumsExtraInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_extra_info', function (Blueprint $table) {
            //
            $table->integer('facilitate')->default(0);
            $table->integer('co-facilitate')->default(0);
            $table->integer('note_taking')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_extra_info', function (Blueprint $table) {
            //
        });
    }
}
