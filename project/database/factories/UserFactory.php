<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'first_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail,
            'is_admin'=>$this->faker->boolean(10),
            'points'=>$this->faker->numberBetween(0,1000)
        ];
    }
}
