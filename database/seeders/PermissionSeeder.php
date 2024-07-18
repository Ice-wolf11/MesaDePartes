<?php

namespace Database\Seeders;

use Faker\Guesser\Name;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            //areas
            'ver-areas',
            'crear-areas',
            'editar-areas',
            'eliminar-areas',
            
            //derivaciones
            'ver-todas-las-derivaciones',
            'ver-mis-derivaciones',
            //'crear-derivacion',//tal vez se elimine
            'eliminar-derivacion',

            //revisiones
            'ver-todas-las-revisiones',
            'ver-mis-revisiones',
            'crear-revision',
            'eliminar-revision',

            //trabajadores-usuarios
            'ver-trabajadores',
            'crear-trabajadores',
            'editar-trabajadores',
            'eliminar-trabajadores',

            //tramites
            'ver-tramites',
            'eliminar-tramites',

            //roles
            'ver-roles',
            'crear-roles',
            'editar-roles',
            'eliminar-roles',
            
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
