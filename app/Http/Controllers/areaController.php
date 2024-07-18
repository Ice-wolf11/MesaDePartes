<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Area;
use App\Http\Controllers\trabajadoreController;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class areaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //para que los permisos funcionen
    public static function middleware(): array
    {
        return [
            'permission:ver-areas|crear-areas|editar-areas|eliminar-areas' => ['only' => ['index']],
            'permission:crear-areas' => ['only' => ['create', 'store']],
            'permission:editar-areas' => ['only' => ['edit', 'update']],
            'permission:eliminar-areas' => ['only' => ['destroy']],
        ];
    }



    /*
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            //'role_or_permission:manager|edit articles',
            
            //opcion1


            //opcion 2
            new Middleware('permission:ver-areas|crear-areas|editar-areas|eliminar-areas', only: ['index']),
            new Middleware('permission:crear-areas', only: ['create','store']),
            new Middleware('permission:editar-areas', only: ['edit','update']),
            new Middleware('permission:eliminar-areas', only: ['destroy']),
        ];
    }
        
    /*function __construct()
    {
        $this->middleware('permission:ver-areas|crear-areas|editar-areas|eliminar-areas',['only'=>['index']]);
        $this->middleware('permission:crear-areas',['only'=>['create','store']]);
        $this->middleware('permission:editar-areas',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-areas',['only'=>['destroy']]);
    }*/


    public function index()
    {
        $area = Area::all();
        //dd($area);
        return view('area.index',['areas' => $area]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
    {
        //dd($request);
        
        try{
            DB::beginTransaction();
            $area = Area::create([
                'nombre' => $request->validated()['nombre']
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('areas.index')->with('success','Area creada correctamente');
        
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
    public function edit(Area $area)
    {
        //dd($area);
        return view('area.edit',['area'=> $area]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        Area::where('id',$area->id)->update($request->validated());
        return redirect()->route('areas.index')->with('success','Area Editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $area = Area::find($id);
        //Area::where('id',$area->id)->update(['nombre'=>'hola']);//esta linea es un ejemplo
        Area::where('id',$area->id)->delete();
        return redirect()->route('areas.index')->with('success','Area Eliminada Correctamente');
        
    }
}
