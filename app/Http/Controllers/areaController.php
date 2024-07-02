<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Area;

class areaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function update(StoreAreaRequest $request, Area $area)
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
