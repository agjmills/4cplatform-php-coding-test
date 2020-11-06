<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace Database\Factories;

use App\Models\Breed;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Breed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'animal_type'       => $this->faker->randomElement(['cat', 'dog']),
            'temperament'       => $this->faker->sentence(),
            'breed'             => $this->faker->words(3),
            'alternative_names' => $this->faker->word,
            'life_span'         => $this->faker->numberBetween(10, 20),
            'origin'            => $this->faker->country,
            'wikipedia_url'     => $this->faker->url,
            'country_code'      => $this->faker->countryCode,
            'description'       => $this->faker->sentence,
        ];
    }
}
