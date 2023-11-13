<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cliente; //Se agrega el modelo de cleinte
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str; //Para usar la función que pasa la cadena de nombre a minúsculas
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles; //Se agrega para usar spatie

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles; //Se le dice que se quiere usar dentro de esta clase

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //Se establece las relaciones entre el modelo de User e Inventario
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }

    //Se establece la relación m:m con cliente, usando tabla pivote
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class)->withPivot('proyecto', 'presupuesto', 'estado');
    }

    //Se implementa un mutator para guardar el nombre de usuario siempre en minúsculas
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::lower($value);
    }
}
