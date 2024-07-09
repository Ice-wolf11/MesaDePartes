<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Trabajadore;

class TrabajadoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trabajadore::Insert([
            [
                'nombre'   => 'Administrador',   
                'apellido' => 'Sistema',
                'area_id'  => '1',
                'user_id'  => '1'
            ],
            
        ]);
    }
}
