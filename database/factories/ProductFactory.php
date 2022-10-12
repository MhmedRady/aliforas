<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    public function definition(): array
    {
        $isHot = rand(0, 1) === 1;
        $price = rand(30, 9999);
        $hotPrice = rand($price * 1.1, 9999 * 1.1);
        $start = now()->addDays(rand(0, 15));
        $end = now()->addDays(rand(30, 120));
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'brand_id' => rand(1, 6),
            'manufacturer_id' => rand(1, 2),
            'stock' => rand(1, 30),
            'minimum_stock' => rand(1, 7),
            'price' => $price,
            'is_active' => rand(0, 1),
            'is_hot' => $isHot,
            'hot_price' => $isHot ? $hotPrice : 0,
            'hot_starts_at' => $isHot ? $start : null,
            'hot_ends_at' => $isHot ? $end : null,
            'up_selling' => rand(0, 1),
            'return_allowed' => rand(0, 1),
            'return_duration' => rand(1, 7),
        ];
    }
}
