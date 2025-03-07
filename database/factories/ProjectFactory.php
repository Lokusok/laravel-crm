<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id');
        $clients = Client::pluck('id');

        $currentStatus = fake()->randomElement(ProjectStatus::cases());
        $completedAt = null;

        if ($currentStatus === ProjectStatus::COMPLETED) {
            $completedAt = now();
        }

        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'deadline_at' => now()->addDays(rand(1, 30))->format('Y-m-d'),
            'completed_at' => $completedAt,
            'status' => $currentStatus->value,
            'user_id' => $users->random(),
            'client_id' => $clients->random(),
        ];
    }
}
