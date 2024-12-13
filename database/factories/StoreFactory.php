<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
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
            'logo_image'=>fake()->imageUrl(),
            'cover_image'=>fake()->imageUrl(),

        ];
    }
}
