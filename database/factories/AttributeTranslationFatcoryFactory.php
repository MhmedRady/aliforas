<?php

namespace Database\Factories;

use App\Models\Translations\AttributeTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeTranslationFatcoryFactory extends Factory
{
    protected $model = AttributeTranslation::class;

    public function definition(): array
    {
        return [
            'locale'        =>  null,
            'attribute_id'  =>  null,
            'name'          =>  $this->faker->word(),
            'is_active'     =>  $this->faker->boolean,
        ];
    }
}
