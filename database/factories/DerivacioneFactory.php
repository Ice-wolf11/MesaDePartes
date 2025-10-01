<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trabajadore;
use App\Models\Tramite;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Derivacione>
 */
class DerivacioneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'trabajadore_id' => Trabajadore::inRandomOrder()->value('id'), // puede ser null si no hay trabajadores
            'tramite_id' => Tramite::inRandomOrder()->value('id'), // debe existir al menos un trámite
        ];
    }
}
