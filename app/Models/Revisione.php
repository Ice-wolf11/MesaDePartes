<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Revisione extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion','ruta_archivo','estado_revision','trabajadore_id','tramite_id'];

    //relacion inversa uno a muchos con tramite
    public function tramite(){
        return $this->belongsTo(Tramite::class);
    }
    //relacion inversa con usuario
    public function trabajador(){
        return $this->belongsTo(Trabajadore::class,'trabajadore_id');
    }
    public static function hambleUploadPDF($pdf)
    {
        $file = $pdf;
        $name = time() . $file->getClientOriginalName();
        //$pdf->move(public_path('/archivos/pdfTramite/'), $name);
        Storage::putFileAs('public/revisiones',$file,$name,'public');
        return $name;
    }
    
}
