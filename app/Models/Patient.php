<?php

namespace App\Models;

use App\Models\MilitaryElements; //Se incluye el modelo de la relación
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['military_element_id', 'disorder', 'severity', 'reports'];

    public function militaryElement()
    {
        return $this->belongsTo(MilitaryElements::class);
    }
}
