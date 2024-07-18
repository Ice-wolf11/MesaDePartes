<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTramiteRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Persona;
use App\Models\Estado;
use App\Models\Tramite;
use App\Models\User;
use App\Models\Derivacione;
use App\Models\Revisione;
use App\Models\Area;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class tramiteController extends Controller
{

    public static function middleware(): array
    {
        return [
            'permission:ver-tramites|eliminar-tramites' => ['only' => ['index']],
            'permission:eliminar-tramites' => ['only' => ['destroy']],
        ];
    }
    
    /*public static function middleware(): array
    {
        return [
            new Middleware('ver-tramites|eliminar-tramites',['only'=>['index']]),
            new Middleware('eliminar-tramites',['only'=>['destroy']]),
            
        ];
    }*/

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
 * Show the confirmation view after successfully storing a tramite.
 */
    public function confirmacion($id)
    {
        $tramite = Tramite::findOrFail($id);
        // Puedes cargar relaciones adicionales si las necesitas
        $tramite->load('persona', 'estado');

        return view('tramite.confirmacion', compact('tramite'));
    }

    public function seguimiento(){
        return view('tramite.show');
    }

    public function buscar(Request $request)
    {
        $numeroExpediente = $request->input('expediente');
        $codigoSeguridad = $request->input('codigoSeguridad');
    
        if (empty($numeroExpediente) || empty($codigoSeguridad)) {
            return response()->json([
                'success' => false,
                'message' => 'Por favor, proporcione todos los campos requeridos.'
            ]);
        }
    
        // Encuentra el tramite por número de expediente y código de seguridad
        $tramite = Tramite::where('id', $numeroExpediente)
            ->where('cod_seguridad', $codigoSeguridad)
            ->with(['persona', 'estado', 'revisiones.trabajador']) // Cargar la relación trabajador
            ->first();
    
        if ($tramite) {
            return response()->json([
                'success' => true,
                'data' => $tramite
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el trámite con el expediente y código de seguridad proporcionados.'
            ]);
        }
    }
    
    


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tramite = Tramite::with('persona', 'estado')->latest()->get();

        //dd($tramite);
        $revisione = Revisione::all();
        $derivacione = Derivacione::all();
        return view('tramite.index',['tramites' => $tramite,'derivacione'=>$derivacione,'revisione'=>$revisione]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tramite.envio');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTramiteRequest $request)
    {

        //generar codigo aleatorio
        $codigoSeguridad = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

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
                'cod_seguridad' => $codigoSeguridad,
                'estado_id' => '1',
                'persona_id' => $persona->id
                
            ]);
            
            // Crear un nuevo trámite asociado a la persona
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('tramites.confirmacion', ['id' => $persona->id])->with('success', 'Documento enviado correctamente');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
