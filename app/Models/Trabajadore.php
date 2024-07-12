<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajadore extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','apellido','area_id','user_id'];

    //realcion con user uno a uno
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion inversa de uno a muchos con area
    public function area(){
        return $this->belongsTo(Area::class);
    }

    //relacion de muchos a muchos con tramites
    /*public function tramites(){
        return $this->belongsToMany(Tramite::class)->withTimestamps()->withPivot('fecha_hora');//nota=> acuerdate de agregar el campo fecha en la tabla revisiones
    }*/
    
    //metodo de relacion principal uno a muchos con revisiones
    public function revisiones(){
        return $this->hasMany(Revisione::class);
    }

    //metodo de relacion principal uno a muchos con derivaciones
    public function derivaciones(){
        return $this->hasMany(Derivacione::class);
    }
}
