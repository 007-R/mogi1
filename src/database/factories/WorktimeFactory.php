<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\worktime;
use app\Models\User;

class WorktimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = '2023-09-18 ';
        $start1 = $date . '7:00';
        $end1 = $date . '10:00';

        $start2 = $date .'17:00';
        $end2 = '2023-09-19 3:00';

        return [
            'user_id' => $this -> faker -> unique -> numberBetween(8,63),
            'start' =>  $this->faker->dateTimeBetween($start1, $end1),
            'end' => $this->faker->dateTimeBetween($start2, $end2),

        ];
    }
}
