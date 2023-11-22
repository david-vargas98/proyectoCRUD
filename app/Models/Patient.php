<?php

namespace App\Models;

use App\Models\MilitaryElements; //Se incluye el modelo de la relación
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['military_element_id', 'disorder', 'severity', 'user_id']; //Se agrega user_id al fillable

    public function militaryElement()
    {
        return $this->belongsTo(MilitaryElements::class)->withTrashed(); //Para poder ver los elementos eliminados
    }

    //Relación 1:m con User
    public function userPsicologo()
    {
        return $this->belongsTo(User::class, 'user_id'); //Se le dice explícitamente que columna buscar
    }

    //Relación 1:m con Appointment
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
