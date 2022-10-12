<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attribute_id' => Attribute::inRandomOrder()->take(1)->first()->id,
            'category_id' => Category::inRandomOrder()->take(1)->first()->id,
            'created_at' => now()
        ];
    }
}
