<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Derivacione;
use App\Models\Tramite;
use App\Models\Trabajadore;

class DerivacioneSeeder extends Seeder
{
    public function run(): void
    {
        $tramites = Tramite::all();
        $trabajadores = Trabajadore::pluck('id')->toArray();

        foreach ($tramites as $tramite) {
            // Número aleatorio de derivaciones (1 a 3)
            $numDerivaciones = rand(1, 3);

            // Selecciona trabajadores diferentes
            $trabajadoresAsignados = collect($trabajadores)
                ->random($numDerivaciones)
                ->all();

            foreach ($trabajadoresAsignados as $trabajadorId) {
                Derivacione::create([
                    'tramite_id' => $tramite->id,
                    'trabajadore_id' => $trabajadorId,
                ]);
            }
        }
    }
}
