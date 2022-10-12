<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFatcory extends Factory
{
    protected $model = Attribute::class;

    public function definition(): array
    {
        return [
            'group_id'  =>  Attribute::inRandomOrder()->take()->first()->id,
            'is_active'  =>  $this->faker->boolean(),
        ];
    }
}
