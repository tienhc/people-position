<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        return [
            'login' => $this->faker->userName,
            'password' => bcrypt('password123'),
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
