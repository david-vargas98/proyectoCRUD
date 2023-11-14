<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteUser extends Model
{
    use HasFactory;

    protected $table = 'cliente_user';

    protected $fillable = ['user_id','cliente_id','proyecto', 'presupuesto', 'estado', 'contrato_ubicacion', 'contrato_nombre'];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
