<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'table_name', 'record_id'];

    //Relación con user para poder recuperar el nombre de los usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
