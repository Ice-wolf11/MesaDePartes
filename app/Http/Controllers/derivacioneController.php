<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDerivacioneRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;
use App\Models\Tramite;
use App\Models\Derivacione;
use App\Models\Trabajadore;
use App\Models\User;
use App\Models\Area;


class derivacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('derivacione.index');
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
        //
    }
}
