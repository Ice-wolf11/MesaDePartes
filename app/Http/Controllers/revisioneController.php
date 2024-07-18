<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTramiteRequest;
use App\Http\Requests\StoreRevisioneRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Persona;
use App\Models\Estado;
use App\Models\Tramite;
use App\Models\User;
use App\Models\Derivacione;
use App\Models\Trabajadore;
use App\Models\Revisione;
use App\Models\Area;

class revisioneController extends Controller
{
    public function verPdf($id)
    {
        $revision = Revisione::findOrFail($id);
        $filePath = 'public/revisiones/' . $revision->ruta_archivo;

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
        //$tramite = Tramite::All();
        $revision = Revisione::with('trabajador', 'tramite')->latest()->get();
        return view('revisione.index',['revisiones' => $revision]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($tramiteId)
    {
        //dd('tramiteId');
        $areas = Area::All();
        $trabajador = Trabajadore::All();
        $tramite = Tramite::with('persona')->findOrFail($tramiteId);
        return view('revisione.create', compact('tramite','areas'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRevisioneRequest $request)
    {
        //dd($request);
        try {
            DB::beginTransaction();
            if ($request->hasFile('formFile')) {
                $archivo = Revisione::hambleUploadPDF($request->file('formFile'));
            } else {
                $archivo = null;
            }

            if ($request->resolucion == '3'){
                $estado_revision = 'Aceptado';
            }else if($request->resolucion == '4'){
                $estado_revision = 'Rechazado';
            }

            $revisione = Revisione::create([
                'descripcion' => $request->validated()['respuesta'],
                'ruta_archivo' => $archivo,
                'estado_revision' => $estado_revision,
                'trabajadore_id' => $request->validated()['trabajador_id'],
                'tramite_id' => $request->validated()['tramite_id'],
            ]);

            if ($request->trabajador != null ){
                $derivacione = Derivacione::create([
                    'trabajadore_id' => $request->validated()['trabajador'],
                    'tramite_id' => $request->validated()['tramite_id'],
                ]);
    
                $tramite = Tramite::findOrFail($request->input('tramite_id'));
                $tramite->update([
                    'estado_id' => '2',
                ]);
            }else{
                $tramite = Tramite::findOrFail($request->input('tramite_id'));
                $tramite->update([
                    'estado_id' => $request->validated()['resolucion'],
                ]);
            }

            

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('revisiones.index')->with('success','Operacion realizada con éxito');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Obtener las derivaciones del trabajador asociado al usuario autenticado
        $revisiones = Revisione::whereHas('trabajador', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        // Retornar una vista con las derivaciones encontradas
        return view('revisione.index', compact('revisiones'));
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
        $derivacion = Revisione::findOrFail($id); // Utiliza findOrFail para manejar el caso en que no se encuentre el trámite

        

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
