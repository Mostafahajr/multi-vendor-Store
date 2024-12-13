<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(2,true);

        return [
            //
            'name' => $name ,
            'description'=>$this->faker->sentence(15),
            'slug'=>Str::slug($name),
            'image'=>fake()->imageUrl(),
            'price'=>fake()->randomFloat(1,1,499),
            'compare_price'=>fake()->randomFloat(1,500,999),
            'rating'=>fake()->randomFloat(1,0,5),
            'store_id'=>Store::inRandomOrder()->first()->id,
            'category_id'=>Category::inRandomOrder()->first()->id,
        ];
    }
}
