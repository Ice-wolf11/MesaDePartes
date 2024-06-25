<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('fecha'); //nota=> acuerdate de agregar este campo en la tabla revisiones
    }


    /*
    //relacion de uno a muchos con revisiones
    public function revisiones(){
        return $this->hasMany(Revisione::class);
    }*/
}

