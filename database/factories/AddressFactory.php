<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\State;
use App\Models\Tehasil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'body' => fake()->name(),
            'pincode' => fake()->numerify('### ###'),
            'state_id' => function (){
                return State::factory()->create()->id;
            },
            'district_id'=> function (){
                return District::factory()->create()->id;
            },
            'tehasils_id' => function (){
                return Tehasil::factory()->create()->id;
            } ,
        ];
    }
}
