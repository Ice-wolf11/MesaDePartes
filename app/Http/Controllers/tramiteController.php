<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTramiteRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Persona;
use App\Models\Estado;
use App\Models\Tramite;
use App\Models\User;


class tramiteController extends Controller
{
    public function verPdf($id)
    {
        $tramite = Tramite::findOrFail($id);
        $filePath = 'public/tramites/' . $tramite->ruta_archivo;

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
        $tramite = Tramite::with('persona', 'estado')->latest()->get();

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
        //$estado = Estado::find(1);
        try{
            DB::beginTransaction();
            if ($request->hasFile('adjuntarArchivo')) {
                $archivo = Tramite::hambleUploadPDF($request->file('adjuntarArchivo'));
            } else {
                $archivo = null;
            }
            //dd($request);
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
                'ruta_archivo' =>$archivo,
                'cod_seguridad' => '1245',
                'estado_id' => '1',
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
        $tramite = Tramite::findOrFail($id); // Utiliza findOrFail para manejar el caso en que no se encuentre el trámite

        $filePath = 'public/tramites/' . $tramite->ruta_archivo;

        try {
            // Comienza una transacción para asegurarte de que ambas operaciones (eliminación del archivo y del registro) se completen
            DB::beginTransaction();

            // Elimina el archivo PDF si existe
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            // Elimina el registro del trámite
            $tramite->delete();

            DB::commit();

            return redirect()->route('tramites.index')->with('success', 'Trámite eliminado correctamente junto con su archivo PDF.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('tramites.index')->with('error', 'Ocurrió un error al eliminar el trámite: ' . $e->getMessage());
        }
    }

}
