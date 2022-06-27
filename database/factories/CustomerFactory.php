<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
    	return [
            'email' => $this->faker->unique()->safeEmail,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'password' => md5($this->faker->name.$this->faker->phoneNumber),
            'gender' => Arr::random(['Male','Female']),
            'country' => 'AU',
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
    	];
    }
}
