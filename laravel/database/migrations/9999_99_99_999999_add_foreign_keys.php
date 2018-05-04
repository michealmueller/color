<?php

use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('timelines', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('timeline_id')
                ->references('id')
                ->on('timelines')
                ->onDelete('cascade');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::table('company_members', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
        });
        Schema::table('skills', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::table('recentactivity', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::table('member_level', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::table('follows', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
