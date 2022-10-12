<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComplaintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complaint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = rand(1,3);
        return [
            'to' => $users,
            'from' => $users == 2?3:2,
            'title' => $this->faker->firstName,
            'body' => $this->faker->text(),
            'created_at' => now(),
        ];
    }

}
