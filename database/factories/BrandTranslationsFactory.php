<?php

namespace Database\Factories;

use App\Models\Translations\BrandTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandTranslationsFactory extends Factory
{
    protected $model = BrandTranslation::class;

    public function definition(): array
    {
        return [
            'brand_id'          =>  null,
            'locale'            =>  null,
            'name'              =>  $this->faker->unique()->company,
            'meta_title'        =>  $this->faker->text(50),
            'meta_keywords'     =>  $this->faker->words(3, true),
            'meta_description'  =>  $this->faker->words(5, true),
        ];
    }
}
