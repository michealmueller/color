<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'username' => $faker->unique()->userName,
        'facebook' => $faker->uuid,
        'twitter' => $faker->uuid,
        'instagram' => $faker->uuid,
        'linkedin' => $faker->uuid,
        'company' => $faker->company,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->streetAddress,
        'bio' => $faker->paragraph,
        'country' => $faker->country,
        'city' => $faker->city,
        'activated' => $faker->numberBetween(0,1),
        'lastpayment' => $faker->dateTimeBetween('32 months ago', 'now'),
        'lastpaymentamount' => $faker->randomNumber(3),
        'created_at' => $faker->dateTimeBetween('32 months ago', 'now'),
        'cmg_position' => $faker->numberBetween(0,3),
        'card_brand' => $faker->creditCardType,
        'card_last_four' => $faker->randomNumber(4),
        'gravatar' => 'http://www.gravatar.com/avatar/'.md5($faker->email).'?s=167&d=identicon',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Events::class, function (Faker\Generator $faker){
    return [
        'event_id' => $faker->numberBetween(1,109),
        'user_id' => $faker->numberBetween(400,500),
        'attendee_type' => $faker->word,
        'amount_paid' => $faker->randomNumber(3),
        'payment_date' => $faker->dateTimeBetween('32 months ago', 'now'),
    ];
});

$factory->define(App\Follow::class, function (Faker\Generator $faker){
    return [
        'follower_id' => $faker->numberBetween(1,150),
        'user_id' => $faker->numberBetween(150,300),
        'created_at' => $faker->dateTimeBetween('32 months ago', 'now'),
        'updated_at' => $faker->dateTimeBetween('32 months ago', 'now'),
    ];
});

$factory->define(App\Timeline::class, function (Faker\Generator $faker){
    return [
        'post_content' => $faker->paragraph,
        'user_id' => $faker->numberBetween(1,300),
        'created_at' => $faker->dateTimeBetween('32 months ago', 'now'),
        'updated_at' => $faker->dateTimeBetween('32 months ago', 'now'),
    ];
});

/*$factory->define(App\Timeline::class, function (Faker\Generator $faker){
    return [
        'company_name' => $faker->company,
        'region' => $faker->
    ];
});*/

