<?php

namespace Workbench\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Workbench\App\Models\Test;

/**
 * @template TModel of \Workbench\App\Models\Test
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class TestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Test::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'array' => ['email' => $this->faker->email, 'password' => $this->faker->password],
            'collection' => collect(['email' => $this->faker->email, 'password' => $this->faker->password]),
            'object' => (object) ['email' => $this->faker->email, 'password' => $this->faker->password],
            'as_encrypted_array_object' => ['email' => $this->faker->email, 'password' => $this->faker->password],
            'as_encrypted_collection' => collect(['email' => $this->faker->email, 'password' => $this->faker->password]),
        ];
    }
}
