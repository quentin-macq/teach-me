<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'name' => $this->faker->name,
            'firstName' => $this->faker->name,
            'role' => $this->faker->word,
            'dateOfBirth' => $this->faker->unique()->date(),
            'phone' => $this->faker->unique()->phoneNumber,
            'biography' => $this->faker->text,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => $this->faker->word,
            'remember_token' => Str::random(10),
        ];
    }
}
