<?php

namespace Database\Factories;

use App\Models\UserAgent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $datetime = $this->faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now');
        return [
            'user_agent_id' => UserAgent::inRandomOrder()->first()->id,
            'ip_address' => $this->faker->unique()->ipv4(),
            'requests' => rand(1, 100),
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }
}