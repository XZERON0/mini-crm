<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => fake()->sentence(),
            'text' => fake()->paragraph(),
            'status' => fake()->randomElement(['Новый', 'В работе', 'Обработан']),
            'manager_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'customer_id' => fake()->numberBetween(1, 50),
        ];
    }
}
