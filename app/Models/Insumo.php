<?php

namespace App\Models;

use App\Models\Inventario; //Se agrega el encabezado del modelo o clase
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;
    protected $fillable = ['insumodescripcion', 'insumocantidad', 'inventario_id'];

        //Relación 1:m; Un (1) inventario puede tener muchos (m) insumos pero INVERSA
        public function inventario() //En singular porque es un inventario
        {
            //Se crea la relación con belongsTo y se especifica el nombre de la columna relacionada
            return $this->belongsTo(Inventario::class)->withTrashed(); //WithTrashed() trae las instancias de inventarios borradas con soft delete
            //También se puede usar: return $this->hasMany('App/Models/Inventario');

            //En este caso, se especificó explícitamente el nombre de la columna en la relación de Eloquent:
            //En Laravel, existe una convención de nomenclatura que facilita la configuración de relaciones Eloquent. Al seguir la convención, Laravel puede inferir automáticamente los nombres de las claves foráneas y las tablas relacionadas:
                //Para una relación belongsTo, se espera que el nombre de la columna sea el nombre del modelo relacionado en singular seguido de "_id". Por ejemplo, se tiene un relación belongsTo con el modelo Inventario, se espera que la columna se llame inventario_id.
                //Para una relación hasMany, se espera que el nombre de la columna sea el nombre del modelo relacionado en plural seguido de "_id". Por ejemplo, se tiene una relación hasMany con el modelo Insumo, se espera que la columna se llame insumos_id.

                //ESTO SOLO APLICA con RELACIONES ELOQUENT, el segundo método de guardado de relaciones, el primero no lo necesita.
        }

}
