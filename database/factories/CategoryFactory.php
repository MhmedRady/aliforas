<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'is_active'     =>  $this->faker->boolean,
            'in_header'     =>  $this->faker->boolean,
            'code'          =>  null,
            'icon'          => $this->faker->imageUrl(),
            'banner'        => $this->faker->imageUrl(),
            'return_policy' => (int) $this->faker->boolean(),
            'arrange'       => $this->faker->numberBetween(1, 100),
            'shipping_value'=> $this->faker->numberBetween(50, 500),
            'shipping_type' => 0,
            'parent_id'     =>  Category::inRandomOrder()->take(1)->first()->id,
        ];
    }
}
