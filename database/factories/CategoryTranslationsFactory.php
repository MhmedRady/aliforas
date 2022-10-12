<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Translations\CategoryTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryTranslationsFactory extends Factory
{
    protected $model = CategoryTranslation::class;

    public function definition(): array
    {
        $category = $this->faker->words(3, true);
        return [
            'category_id'       =>  null,
            'locale'            =>  null,
            'name'              =>  $category,
            'slug'              =>  Str::slug($category),
            'description'       =>  $this->faker->paragraphs(2, true),
            'meta_title'        =>  $this->faker->text(50),
            'meta_keywords'     =>  $this->faker->words(3, true),
            'meta_description'  =>  $this->faker->words(5, true),
        ];
    }
}
