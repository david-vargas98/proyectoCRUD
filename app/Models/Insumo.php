<?php

namespace App\Models;

use App\Models\Inventario; //Se agrega el encabezado del modelo o clase
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

        //Relación 1:m; Un (1) inventario puede tener muchos (m) insumos pero INVERSA
        public function inventario() //En singular porque es un inventario
        {
            //Se crea la relación con belongsTo
            return $this->belongsTo(Inventario::class);
            //También se puede usar: return $this->hasMany('App/Models/Inventario');
        }

}
