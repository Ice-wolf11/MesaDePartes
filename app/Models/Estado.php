<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    //relacion uno a muchos con tramites
    public function tramites(){
        return $this->hasMany(Tramite::class);
    }

}
