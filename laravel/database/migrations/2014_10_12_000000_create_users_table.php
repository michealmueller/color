<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('isAdmin')->default(0);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('membership_type')->nullable();
            $table->string('facebook')->unique()->nullable();
            $table->string('twitter')->unique()->nullable();
            $table->string('instagram')->unique()->nullable();
            $table->string('linkedin')->unique()->nullable();
            $table->string('company')->nullable();
            $table->string('compweb')->nullable();
            $table->string('position')->nullable();
            $table->string('consumer')->nullable();
            $table->string('contract')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('gravatar')->nullable();
            $table->string('address')->nullable();
            $table->text('bio')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('password');
            $table->integer('activated')->default(0);
            $table->integer('deactivated')->nullable()->default(0);
            $table->integer('cmg_position')->nullable()->default(0); //todo: 1 -> Board Member, 2->Commitee Member, 3->Executive Committe Member, 0 -> regular member
            $table->string('hash')->unique()->nullable();
            $table->boolean('speaker_presenter')->default(0)->nullable();
            $table->string('material')->nullable();  //todo::what they present/speak about.
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->string('products_services')->nullable();
            $table->date('lastpayment')->nullable();
            $table->float('lastpaymentamount')->nullable();
            $table->rememberToken();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
