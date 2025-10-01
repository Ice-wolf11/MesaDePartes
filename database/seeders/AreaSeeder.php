<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos fijos
        Area::insert([
            ['nombre' => 'Soporte Tecnico'],
        ]);

        $areas = ['Contabilidad','Recursos Humanos','Sistemas','Marketing','Ventas','Compras','Logística','Finanzas','Legal','Atención al Cliente'];

        foreach ($areas as $nombre) {
            Area::create(['nombre' => $nombre]);
        }
    }
}
