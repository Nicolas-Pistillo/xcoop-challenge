<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->name,
            'profession'  => Arr::random([
                'designer', 'medic', 'student', 'developer', 'mechanic', 'gardener'
            ]),
            'legal_doc'   => $this->faker->numberBetween(40000000,99999999)
        ];
    }
}
