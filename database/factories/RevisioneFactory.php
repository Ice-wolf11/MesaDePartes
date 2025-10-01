<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trabajadore;
use App\Models\Tramite;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Revisione>
 */
class RevisioneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->sentence(10),
            'ruta_archivo' => $this->faker->optional()->filePath(),
            'estado_revision' => $this->faker->randomElement(['Pendiente', 'Aprobado', 'Rechazado']),
            'trabajadore_id' => Trabajadore::inRandomOrder()->value('id'),
            'tramite_id' => Tramite::inRandomOrder()->value('id'),
        ];
    }
}
