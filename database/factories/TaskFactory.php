<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $priorityCounter = 1; // Initialize a static counter variable
        static $project_id = 1;

        $priority = $priorityCounter;
        $priorityCounter++; // Increment the counter for the next task

        $project_id = rand(1, 20);

        return [
            'name' => fake()->name(),
            'priority' => $priority,
            'project_id' => $project_id,
        ];
    }
}