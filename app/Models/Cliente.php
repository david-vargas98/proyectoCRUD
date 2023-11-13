<?php

namespace App\Models;

use App\Models\User; //Se agrega el modelo user
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;  //Se agrega la clase Carbon para usar el método parse

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombrecliente', 'apellidopat', 'apellidomat', 'fechanacimiento', 'correo', 'telefono', 'direccion', 'ciudad', 'estado', 'pais'];

    //Se implementa la relación m:m del Cliente con User, usando tabla pivote
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('proyecto', 'presupuesto', 'estado');
    }

    //Se implementa un Accessor para mostrar la fecha en el formato d-m-a, ya que se guarda como a-m-d
    public function getFechaNacimientoAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
