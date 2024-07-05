<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTrabajadoreRequest;
use App\Http\Requests\UpdateTrabajadoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Trabajadore;
use App\Models\User;
use App\Models\Area;

class trabajadoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trabajador = Trabajadore::with('user','area')->latest()->get();
        //dd($area);
        return view('trabajador.index',['trabajadores' => $trabajador]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*$trabajador = Trabajadore::with('user','area')->latest()->get();
        //dd($area);
        return view('trabajador.create',['trabajadores' => $trabajador]);*/
        $areas = Area::all(); // Obtener todas las áreas
        //$roles = Role::all(); // Obtener todos los roles
        return view('trabajador.create', ['areas' => $areas, /*'roles' => $roles*/]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrabajadoreRequest $request)
    {
        $fieldHash = Hash::make($request->password);
        //Modificar el valor de password en nuestro request
        $request->merge(['password' => $fieldHash]);
        //dd($request);
        try{
            //creando usuario
            DB::beginTransaction();
            //Encriptar contraseña
           
            $user = User::create([
                'name' => $request->validated()['nombre'],
                'email' => $request->validated()['email'],
                'password' => $request->validated()['password'],

            ]);
            $trabajador= Trabajadore::create([
                'nombre' => $request->validated()['nombre'],
                'apellido' => $request->validated()['apellido'],
                'area_id' => $request->validated()['area'],
                'user_id' => $user->id,
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('trabajadores.index')->with('success','Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /*public function edit(Trabajadore $trabajador)
    {
        $areas = Area::all(); // Obtener todas las áreas
        //dd($trabajador);
        return view('trabajador.edit', ['trabajadore' => $trabajador, 'areas' => $areas]);
    }*/
    public function edit(Trabajadore $trabajadore)
{
    $areas = Area::all(); // Obtener todas las áreas
    //dd($trabajadore);
    return view('trabajador.edit', ['trabajador' => $trabajadore, 'areas' => $areas]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrabajadoreRequest $request, Trabajadore $trabajadore)
    {
        $firstName = explode(' ', trim($request->validated()['nombre']))[0];
        $lastName = explode(' ', trim($request->validated()['apellido']))[0];
        $fullName = $firstName . ' ' . $lastName;

        $user = $trabajadore->user;
        $user->name = $fullName;
        $user->email = $request->validated()['email'];
        if ($request->filled('password')) {
            $user->password = Hash::make($request->validated()['password']);
        }
        $user->save();

        $trabajadore->nombre = $request->validated()['nombre'];
        $trabajadore->apellido = $request->validated()['apellido'];
        $trabajadore->area_id = $request->validated()['area'];
        $trabajadore->save();

        return redirect()->route('trabajadores.index')->with('success', 'Usuario editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //$area = Area::find($id);
        $trabajador = Trabajadore::find($id);
        $trabajador->user()->delete(); // Eliminar el usuario asociado
        $trabajador->delete(); // Eliminar el trabajador

        return redirect()->route('trabajadores.index')->with('success', 'Usuario eliminado correctamente');
    }
}
