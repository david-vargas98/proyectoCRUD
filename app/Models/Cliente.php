<?php

namespace App\Models;

use App\Models\User; //Se agrega el modelo user
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    //Se implementa la relación m:m del Cliente con User, usando tabla pivote
    public function cliente_user()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_user', 'cliente_id', 'user_id');
    }
}
