<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyLog>
 */
class DailyLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'note' => $this->faker->text(200), // Generates a random text with 200 characters
            'quality' => $this->faker->numberBetween(-2, 2), // Generates a number between -2 and 2
            'hours_worked' => $this->faker->randomFloat(1, 0, 8), // Generates a decimal between 0 and 24
            'user_id' => 1,
            'created_at' => $date = $this->faker->dateTimeBetween('-2 weeks', 'now'),
            'updated_at' => $date,
            
        ];
    }
}
