<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Categories;
use App\Models\Location;
use App\Models\SubCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shops>
 */
class ShopsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'contact_number' => fake()->numerify('##########'),
            'open_24' => fake()->randomElement([0,1]),
            'open_time' => fake()->time('H:i'),
            'close_time' => fake()->time('H:i'),
            'visit_count' => fake()->numberBetween(1,100),
            'address_id' => function (){
                return Address::factory()->create()->id;
            },
            'location_id' => function (){
                return Location::factory()->create()->id;
            },
            'category_id' => function (){
                return Categories::factory()->create()->id;
            },
            'sub_category_id' => function (){
                return SubCategories::factory()->create()->id;
            }
        ];
    }
}
