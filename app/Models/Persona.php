<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    //metodo de relacion 
    public function tramites(){
        return $this->hasMany(Tramite::class);
    }

    protected $fillable = ['nombre','tipo_persona','numero_documento','email','telefono'];
}
