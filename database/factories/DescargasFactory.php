<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DescargasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'archivos_id' => 1,
            'user_id' => 1,
            'status' => 1,
        ];
    }
}