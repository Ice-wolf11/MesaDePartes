<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tramite extends Model
{
    use HasFactory;

    //relacion inversa uno a muchos con persona
    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    //relacion inversa con Estado
    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    //relacion muchos a muchos con usuario
    /*public function users(){
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('fecha_hora','descripcion','ruta_archivo'); //nota=> acuerdate de agregar este campo en la tabla revisiones
    }*/
    
    protected $fillable = ['tipo_tramite','folios','asunto','ruta_archivo','cod_seguridad','estado_id','persona_id'];

    
    //relacion de uno a muchos con revisiones
    public function revisiones(){
        return $this->hasMany(Revisione::class);
    }

    //relacion de uno a muchos con derivaciones
    public function derivaciones(){
        return $this->hasMany(Derivacione::class);
    }

    public static function hambleUploadPDF($pdf)
    {
        $file = $pdf;
        $name = time() . $file->getClientOriginalName();
        //$pdf->move(public_path('/archivos/pdfTramite/'), $name);
        Storage::putFileAs('public/tramites',$file,$name,'public');
        return $name;
    }

    /*public function verPdf($id)
    {
        $tramite = Tramite::findOrFail($id);
        $rutaArchivo = public_path('/archivos/pdfTramite/') . $tramite->ruta_archivo;

        if (file_exists($rutaArchivo)) {
            return response()->file($rutaArchivo);
        } else {
            return redirect()->back()->with('error', 'El archivo no existe.');
        }
    }*/

}