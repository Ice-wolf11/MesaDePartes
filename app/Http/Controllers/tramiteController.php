<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTramiteRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use App\Models\Estado;
use App\Models\Tramite;


class tramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tramite = Tramite::with('persona', 'estado')->get();

        //dd($tramite);
        return view('tramite.index',['tramites' => $tramite]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTramiteRequest $request)
    {
        //dd($request);
        $estado = Estado::find(1);
        try{
            DB::beginTransaction();
            $persona = Persona::create([
                'nombre' => $request->validated()['nombre'],
                'tipo_persona' => $request->validated()['tipoPersona'],
                'numero_documento' => $request->validated()['dniRuc'],
                'email' => $request->validated()['email'],
                'telefono' => $request->validated()['telefono']
            ]);
            $persona->tramites()->create([
                'tipo_tramite' => $request->validated()['otroTipoDocumento'] ?? $request->validated()['tipoDocumento'],
                'folios' => $request->validated()['cantidadFolios'],
                'asunto' => $request->validated()['asunto'],
                'ruta_archivo' => $request->validated()['adjuntarArchivo'],
                'cod_seguridad' => '1245',
                'estado_id' => $estado->id,
                'persona_id' => $persona->id
                
            ]);
            // Crear un nuevo trámite asociado a la persona
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('envio')->with('success','Documento enviado correctamente');
        
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
