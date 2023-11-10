<?php

namespace App\Models;

use App\Models\User; //Se agrega el modelo user
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nombrecliente', 'apellidopat', 'apellidomat', 'fechanacimiento', 'correo', 'telefono', 'direccion', 'ciudad', 'estado', 'pais'];

    //Se implementa la relación m:m del Cliente con User, usando tabla pivote
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('proyecto', 'presupuesto', 'estado');
    }
}
