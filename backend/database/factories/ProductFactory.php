<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $number = rand(1,3);
        return [
            'product' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'style' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'description' =>  $this->faker->paragraph($nbSentences = 10, $variableNbSentences = true),
            'auction_price' => $this->faker->numberBetween(200,10000),
            'image_path1' => asset('assets/img/product' . $number . '.jpg'),
            'image_path2' => asset('assets/img/product' . $number . '-1.jpg'),
            'image_path3' => asset('assets/img/product' . $number . '-2.jpg'),
            'start' => Carbon::now(),
            'end'   => Carbon::now()->addDays(2)
        ];
    }
}
