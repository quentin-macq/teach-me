<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

class CourseFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->paragraph(2, true),
            'video_url' => null,
            'date' => $this->faker->date(),
            'subject' => $this->faker->word,
            'level' => $this->faker->word,
            'duration' => $this->faker->numberBetween(1, 100),
            'validity' => null,
            'user_id' => User::all()->random()->id,
        ];
    }
}
