<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'tipo_persona' => $this->faker->randomElement(['Natural', 'Jurídica']),
            'numero_documento' => $this->faker->unique()->numerify('###########'), // 11 dígitos
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->numerify('##########'), // 10 dígitos
        ];
    }
}
