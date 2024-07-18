<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDerivacioneRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Estado;
use App\Models\Tramite;
use App\Models\Derivacione;
use App\Models\Trabajadore;
use App\Models\User;
use App\Models\Area;


class derivacioneController extends Controller
{

    
    public static function middleware(): array
    {
        return [
            'permission:ver-todas-las-derivaciones|ver-mis-derivaciones|eliminar-derivacion' => ['only' => ['index']],
            'permission:ver-mis-derivaciones' => ['only' => ['show']],
            'permission:eliminar-derivacion' => ['only' => ['delete']],
        ];
    }
    
    
    
    
    /*public static function middleware(): array
    {
        return [
            new Middleware('ver-roles|crear-roles|editar-roles|eliminar-roles', ['only' => ['index']]),
            new Middleware('crear-roles', ['only' => ['create', 'store']]),
            new Middleware('editar-roles', ['only' => ['edit', 'update']]),
            new Middleware('eliminar-roles', ['only' => ['destroy']]),
        ];
    }

    /*function __construct()
    {
        $this->middleware('permission:ver-todas-las-derivaciones|ver-mis-derivaciones|eliminar-derivacion',['only'=>['index']]);
        $this->middleware('permission:ver-mis-derivaciones',['only'=>['show']]);
        $this->middleware('permission:eliminar-derivacion',['only'=>['delete']]);
        
    }*/

    public function verPdf($id)
    {
        $derivacion = Derivacione::findOrFail($id);
        $filePath = 'public/tramites/' . $derivacion->tramite->ruta_archivo;

        if (Storage::exists($filePath)) {
            return Storage::response($filePath);
        } else {
            abort(404, 'Archivo no encontrado.');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $derivacion = Derivacione::with('trabajador', 'tramite')->latest()->get();
        return view('derivacione.index',['derivaciones' => $derivacion]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($tramiteId)
    {
        $areas = Area::All();
        $trabajador = Trabajadore::All();
        $tramite = Tramite::with('persona')->findOrFail($tramiteId);
        return view('derivacione.create', compact('tramite','areas'));
    }

    public function getTrabajadoresByArea($area_id)
    {
        $trabajadores = Trabajadore::where('area_id', $area_id)->get();
        return response()->json($trabajadores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDerivacioneRequest $request)
    {
        //dd($request);
        //$tramite = Tramite::All();
        try{
            
            DB::beginTransaction();
            $derivacione = Derivacione::create([
                'trabajadore_id' => $request->validated()['trabajador'],
                'tramite_id' => $request->validated()['tramite_id'],
            ]);

            $tramite = Tramite::findOrFail($request->input('tramite_id'));
            $tramite->update([
                'estado_id' => '2',
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('tramites.index')->with('success','Operacion realizada con éxito');
    }
    
    //buscar derivaciones por usuario
    /*public function showDerivaciones()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtener las derivaciones del trabajador asociado al usuario autenticado
        $derivaciones = Derivacione::whereHas('trabajador', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        // Retornar una vista con las derivaciones encontradas
        return view('derivacione.pendientes', compact('derivaciones'));
    }*/

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtener las derivaciones del trabajador asociado al usuario autenticado
        $derivaciones = Derivacione::whereHas('trabajador', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        // Retornar una vista con las derivaciones encontradas
        return view('derivacione.show', compact('derivaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $derivacion = Derivacione::findOrFail($id); // Utiliza findOrFail para manejar el caso en que no se encuentre el trámite

        

        try {
            // Comienza una transacción para asegurarte de que ambas operaciones (eliminación del archivo y del registro) se completen
            DB::beginTransaction();
            // Elimina el registro del trámite
            $derivacion->delete();

            DB::commit();

            return redirect()->route('derivaciones.index')->with('success', 'Operacion realizada con éxito');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('derivaciones.index')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }
}
