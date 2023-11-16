<?php

namespace App\Models;

use App\Models\Patient;  //Se inlcuye el modelo de la relación
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MilitaryElements extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'birthdate', 'cellphone', 'address', 'admission', 'militarygrade', 'location', 'unit', 'servicestate'];

    //Relación 1:1 con paciente
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}