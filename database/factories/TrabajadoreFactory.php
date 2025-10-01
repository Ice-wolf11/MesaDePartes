<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Area;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trabajadore>
 */
class TrabajadoreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'area_id' => Area::inRandomOrder()->value('id'), // requiere que existan áreas
            'user_id' => User::inRandomOrder()->value('id'), // requiere usuarios
        ];
    }
}
