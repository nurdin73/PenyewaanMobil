<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::pluck('id')->toArray();
        return [
            'owner_id' => $this->faker->randomElement($user), 
            'merk' => $this->faker->name,
            'model' => $this->faker->name,
            'no_plat' => $this->faker->randomNumber(),
            'price_rent_by_day' => 1000
        ];
    }
}