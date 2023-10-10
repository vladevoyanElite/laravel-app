<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Feedback>
 */
class FeedbackFactory extends Factory
{
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->email(),
            'name' => $this->faker->name,
            'comment' => $this->faker->text,
            'rating' => $this->faker->numberBetween(1, 5),
            'product_id' => Product::factory()->create(),
            'photo' => $this->faker->image,
        ];
    }
}
