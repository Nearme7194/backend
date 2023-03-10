<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tehasil>
 */
class TehasilFactory extends Factory
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
            'state_id' => function (){
                return State::factory()->create()->id;
            },
            'district_id' => function (){
                return District::factory()->create()->id;
            }
        ];
    }
}
