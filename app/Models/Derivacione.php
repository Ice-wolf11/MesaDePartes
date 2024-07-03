<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Derivacione extends Model
{
    use HasFactory;

    //relacion inversa uno a muchos con tramite
    public function tramite(){
        return $this->belongsTo(Tramite::class);
    }
    //relacion inversa con usuario
    public function trabajador(){
        return $this->belongsTo(Trabajadore::class);
    }
}
