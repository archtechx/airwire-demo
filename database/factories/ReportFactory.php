<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'assignee_id' => User::all()->random(),
            'category' => $this->faker->randomElement([1, 2, 3]),
            'status' => $this->faker->randomElement(['pending', 'resolved', 'invalid']),
        ];
    }
}
