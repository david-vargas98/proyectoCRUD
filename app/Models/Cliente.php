<?php

namespace App\Models;

use App\Models\User; //Se agrega el modelo user
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    //Se implementa la relación del Cleinte con User, ya que un cliente solo puede ser un usuario
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
