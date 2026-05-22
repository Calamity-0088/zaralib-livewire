<?php

namespace Database\Factories;

use App\Models\Manga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Manga>
 */
class MangaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // * Genera un array con 3 elementos aleatorios y los une en un string separados por coma.
        $genre = implode(', ', $this->faker->randomElements(['Action', 'Adventure', 'Drama', 'Fantasy', 'Horror', 'Sci-Fi'], 3));
        $status = $this->faker->randomElement(['ongoing', 'completed', 'hiatus', 'cancelled', 'not_yet_released']);
        $startDate = $this->faker->date();
        $endDate = $this->faker->dateTimeBetween($startDate, 'now')->format('Y-m-d');

        return [
            'title' => $this->faker->unique()->sentence(3),
            'synopsis' => $this->faker->paragraphs(2, true),
            'author' => $this->faker->name(),
            'genre' => $genre,
            'volumes' => $this->faker->numberBetween(1, 50),
            'chapters' => $this->faker->numberBetween(10, 900),
            'status' => $status,
            /*             'rating' => $this->faker->randomFloat(1, 1, 10), */
            'start_date' => $startDate,
            'end_date' => in_array($status, ['completed', 'cancelled'])
                ? $endDate
                : null,
            'cover_image' => 'images/cover.jpg'
        ];
    }
}
