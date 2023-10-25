<?php

namespace App\Models;

use App\Models\Insumo; //Se agrega el encabezado del modelo o clase
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    //Atributos Rellenables (Fillable Attributes): En un modelo de Laravel, los atributos que se pueden asignar de forma masiva deben estar especificados en una propiedad llamada $fillable. Este es un array que contiene los nombres de los atributos que puedes asignar masivamente:
    protected $fillable = ['descripcion', 'user_id']; //Se debe agregar la columna de user_id, sino, no lo agrega y truena la consulta

    //Relación 1:m; Un (1) inventario puede tener muchos (m) insumos
    public function insumos() //En plural porque son muchos insumos
    {
        //Se crea la relación con hasMany y se especifica el nombre de la columna relacionada
        return $this->hasMany(Insumo::class);
        //También se puede usar: return $this->hasMany('App/Models/Insumo');

        //En este caso, se especificó explícitamente el nombre de la columna en la relación de Eloquent:
            //En Laravel, existe una convención de nomenclatura que facilita la configuración de relaciones Eloquent. Al seguir la convención, Laravel puede inferir automáticamente los nombres de las claves foráneas y las tablas relacionadas:
                //Para una relación belongsTo, se espera que el nombre de la columna sea el nombre del modelo relacionado en singular seguido de "_id". Por ejemplo, se tiene un relación belongsTo con el modelo Inventario, se espera que la columna se llame inventario_id.
                //Para una relación hasMany, se espera que el nombre de la columna sea el nombre del modelo relacionado en plural seguido de "_id". Por ejemplo, se tiene una relación hasMany con el modelo Insumo, se espera que la columna se llame insumos_id.

                //ESTO SOLO APLICA con RELACIONES ELOQUENT, el segundo método de guardado de relaciones, el primero no lo necesita.
    }

    //Se agrega establece las relaciones entre el modelo de Inventario y User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
