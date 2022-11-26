<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jenssegers\Agent\Agent;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAgent>
 */
class UserAgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $requestUserAgent = $this->faker->unique()->userAgent();
        $agent = new Agent();
        $agent->setUserAgent($requestUserAgent);
        return [
            'device' => $agent->device() ?: null,
            'platform' => $agent->platform() ?: null,
            'browser' => $agent->browser() ?: null,
            'robot' => $agent->robot() ?: null,
            'is_desktop' => $agent->isDesktop(),
            'is_phone' => $agent->isPhone(),
            'is_robot' => $agent->isRobot(),
        ];
    }
}

