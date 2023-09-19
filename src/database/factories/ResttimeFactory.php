<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ResttimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = '2023-09-10 ';
        $start1 = $date . '14:00';
        $end1 = $date . '15:00';
        $start2 = $date . '15:00';
        $end2 = $date . '16:00';

        return [
            'worktime_id' => $this -> faker-> unique -> numberBetween(201,300),
            'start' =>  $this->faker->dateTimeBetween($start1, $end1),
            'end' => $this->faker->dateTimeBetween($start2, $end2),

        ];
    }
}
