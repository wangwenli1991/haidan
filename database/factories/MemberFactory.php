<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Members::class, function (Faker $faker) {
    static $password='abc123';
    return [
        //
        'account'=>$faker->unique()->phoneNumber,
        'nickname'=>$faker->name,
        'avator'=>$faker->numberBetween(34,52),
        'sex'=>$faker->numberBetween(0,2),
        'balance'=>$faker->numberBetween(0,20000),
        'password' => bcrypt('secret'),
        'monologue'=>$faker->sentence(5),
        'last_login_time'=>$faker->dateTime('now')
    ];
});
