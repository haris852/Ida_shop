<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'from' => 3,
            'to' => 1,
            'message' => $this->faker->text,
            'is_read' => rand(0, 1),
        ];
    }
}
