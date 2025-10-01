<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Revisione;
use App\Models\Tramite;
use App\Models\Trabajadore;

class RevisioneSeeder extends Seeder
{
    public function run(): void
    {
        $trabajadores = Trabajadore::pluck('id')->toArray();

        // Recorremos todos los trámites
        foreach (Tramite::all() as $tramite) {
            // Cada trámite tendrá 1 o 2 revisiones
            $numRevisiones = rand(1, 2);

            // Seleccionamos trabajadores distintos
            $trabajadoresAsignados = collect($trabajadores)
                ->random($numRevisiones)
                ->all();

            foreach ($trabajadoresAsignados as $trabajadorId) {
                Revisione::create([
                    'descripcion' => fake()->sentence(10),
                    'ruta_archivo' => fake()->optional()->filePath(),
                    'estado_revision' => fake()->randomElement(['Pendiente', 'Aprobado', 'Rechazado']),
                    'trabajadore_id' => $trabajadorId,
                    'tramite_id' => $tramite->id,
                ]);
            }
        }
    }
}
