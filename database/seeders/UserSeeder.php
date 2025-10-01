<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // Crear usuario administrador fijo
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Roles y permisos
        $rolAdmin = Role::create(['name' => 'Administrador']);
        $permisos = Permission::pluck('id','id')->all();
        $rolAdmin->syncPermissions($permisos);
        $user->assignRole('Administrador');

        // Otros 5 roles con mismos permisos
        $rolesExtras = ['Director','Jefe de Área','Secretario','Profesor','Trabajador'];
        foreach ($rolesExtras as $rolNombre) {
            $rol = Role::create(['name'=>$rolNombre]);
            $rol->syncPermissions($permisos);
        }

        // Generar 1000 usuarios aleatorios
        User::factory()->count(50)->create();
    }
}
