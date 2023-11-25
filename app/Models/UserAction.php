<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class UserAction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'table_name', 'record_id'];

    //Relación con user para poder recuperar el nombre de los usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Se implementa un Accessor para mostrar la fecha en el formato d-m-a, ya que se guarda como a-m-d
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }
}
