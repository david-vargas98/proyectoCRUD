<?php

namespace App\Models;

use App\Models\Insumo; //Se agrega el encabezado del modelo o clase
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    //Relación 1:m; Un (1) inventario puede tener muchos (m) insumos
    public function insumos() //En plural porque son muchos insumos
    {
        //Se crea la relación con hasMany
        return $this->hasMany(Insumo::class);
        //También se puede usar: return $this->hasMany('App/Models/Insumo');
    }
}
