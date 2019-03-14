<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Proposal::class, function (Faker $faker) {
    static $supervisor_id;

    return [
        'client_name' => $this->faker->name,
        'client_number' => null,
        'email' => $this->faker->email,
        'address' => $this->faker->address,
        'phone' => $this->faker->phoneNumber,
        'cr_number' => (string) $this->faker->randomNumber(5),
        'supervisor_id' => null,
    ];
});
