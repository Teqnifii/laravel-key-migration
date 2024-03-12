<?php

namespace Workbench\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Workbench\App\Models\Folder\Folder2\Test3;

/**
 * @template TModel of \Workbench\App\Models\Folder\Folder2\Test3
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class Test3Factory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Test3::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text
        ];
    }
}
