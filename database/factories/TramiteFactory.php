<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Persona;
use App\Models\Estado;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tramite>
 */
class TramiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tipo_tramite' => $this->faker->randomElement(['Solicitud', 'Reclamo', 'Queja', 'Otro']),
            'folios' => (string) $this->faker->numberBetween(1, 99), // 2 caracteres
            'asunto' => $this->faker->sentence(6),
            'ruta_archivo' => $this->faker->filePath(), // puedes cambiar por storage/app/archivos si lo deseas
            'cod_seguridad' => $this->faker->unique()->bothify('???###'), // Ejemplo: ABC123
            'estado_id' => Estado::inRandomOrder()->value('id'), // requiere que existan estados
            'persona_id' => Persona::inRandomOrder()->value('id'), // usa personas ya creadas
        ];
    }
}
