<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->title,
            'description' => $this->faker->text(50),
            'price' => $this->faker->numberBetween(100,500),
            'quantity' => $this->faker->numberBetween(1,5),
            'thumbnail' => $this->faker->image(public_path('images'), 300, 300, null, false),
            'is_active' => 1,
        ];
    }
}
